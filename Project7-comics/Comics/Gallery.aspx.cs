using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Windows.Forms;

namespace Comics
{
    public partial class Gallery : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (User.Identity.IsAuthenticated)
            {
                string user = Membership.GetUser().ToString();

                HyperLinkProfile.Text = user;
                HyperLinkProfile.NavigateUrl = "~/Profile.aspx";
                HyperLinkProfile.Visible = true;

                HyperLinkCart.Text = "<i class='fa fa-shopping-cart'></i>";
                HyperLinkCart.NavigateUrl = "~/Cart.aspx";
                HyperLinkCart.Visible = true;
            }

            //Initial Gallery
            string query2 = "SELECT TOP 1 * FROM Gallery";
            string strComic2 = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic2 = new SqlConnection(strComic2);
            SqlCommand sqlCommand2 = new SqlCommand(query2, connComic2);

            DataTable dataCategory2 = new DataTable();
            SqlDataAdapter adapterCategory2 = new SqlDataAdapter(sqlCommand2);
            adapterCategory2.Fill(dataCategory2);

            DataRow rc = dataCategory2.Rows[0];
            string initialGalleryId = rc["IdGallery"].ToString();

            //Initial Images
            string query = "SELECT * FROM Image WHERE galleryId = '" + initialGalleryId + "'";
            string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic = new SqlConnection(strComic);
            SqlCommand sqlCommand = new SqlCommand(query, connComic);

            DataTable dataCategory = new DataTable();
            SqlDataAdapter adapterCategory = new SqlDataAdapter(sqlCommand);
            adapterCategory.Fill(dataCategory);

            HtmlGenericControl imageWrapper;

            foreach (DataRow rowCategory in dataCategory.Rows)
            {
                string idImage = rowCategory["IdImage"].ToString();
                string imagePath = rowCategory["imagePath"].ToString();
                string imageThumb = rowCategory["imageThumb"].ToString();

                imageWrapper = CreateDiv("image_wrapper");
                imageWrapper.Attributes["class"] = "image-wrapper";

                System.Web.UI.WebControls.Image img = new System.Web.UI.WebControls.Image();
                img.ImageUrl = imagePath;
                img.Width = 150;
                img.Height = 150;

                imageWrapper.Controls.Add(img);

                PlaceHolderSelectedGallery.Controls.Add(imageWrapper);
            }
        }

        protected void btnPick_Click(object sender, EventArgs e)
        {
            //PickGallery
            PlaceHolderSelectedGallery.Controls.Clear();
            string galleryPick = DropDownListGallery.SelectedItem.Value.ToString();

            string query = "SELECT * FROM Image WHERE galleryId = '" + galleryPick + "'";
            string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic = new SqlConnection(strComic);
            SqlCommand sqlCommand = new SqlCommand(query, connComic);

            DataTable dataCategory = new DataTable();
            SqlDataAdapter adapterCategory = new SqlDataAdapter(sqlCommand);
            adapterCategory.Fill(dataCategory);

            HtmlGenericControl imageWrapper;

            foreach (DataRow rowCategory in dataCategory.Rows)
            {
                string idImage = rowCategory["IdImage"].ToString();
                string imagePath = rowCategory["imagePath"].ToString();
                string imageThumb = rowCategory["imageThumb"].ToString();

                imageWrapper = CreateDiv("image_wrapper");
                imageWrapper.Attributes["class"] = "image-wrapper";

                System.Web.UI.WebControls.Image img = new System.Web.UI.WebControls.Image();
                img.ImageUrl = imagePath;
                img.Width = 150;
                img.Height = 150;

                imageWrapper.Controls.Add(img);
                PlaceHolderSelectedGallery.Controls.Add(imageWrapper);
            }
        }

        protected void btnUpload_Click(object sender, EventArgs e)
        {
            //YourOwn
            if(FileUploadImage.HasFile)
            {
                if(FileUploadImage.PostedFile.ContentType == "image/jpg" ||
                    FileUploadImage.PostedFile.ContentType == "image/jpeg" ||
                    FileUploadImage.PostedFile.ContentType == "image/png")
                {
                    int idGallery = Int32.Parse(DropDownListSetGallery.SelectedValue);

                    string imageFileName = FileUploadImage.PostedFile.FileName;
                    string imageSafeFileName = Path.GetFileNameWithoutExtension(imageFileName);
                    string imageExtension = Path.GetExtension(imageFileName);
                    Int32 intTimestamp = (Int32)(DateTime.UtcNow.Subtract(new DateTime(1970, 1, 1))).TotalSeconds;
                    string timestamp = intTimestamp.ToString();

                    char[] toTrim = {'.'};
                    string ext = imageExtension.Trim(toTrim);

                    string imageName = String.Format("{0}{1}{2}", imageSafeFileName, timestamp, imageExtension);
                    string uploadImagePath = "~/assets/images/";
                    string uploadThumbPath = "~/assets/images/thumb/";

                    string query = "INSERT INTO [Image] (imagePath, imageThumb, galleryId) VALUES (@imagePath, @imageThumb, @galleryId)";
                    string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
                    SqlConnection connComic = new SqlConnection(strComic);
                    SqlCommand sqlCommand = new SqlCommand(query, connComic);

                    try
                    {
                        FileUploadImage.SaveAs(Server.MapPath(uploadImagePath)+imageName);

                        System.Drawing.Image i = System.Drawing.Image.FromFile(Server.MapPath(uploadImagePath)+imageName);
                        System.Drawing.Image thumb = i.GetThumbnailImage(150, 150, () => false, IntPtr.Zero);
                        thumb.Save(Path.ChangeExtension(Server.MapPath(uploadThumbPath) + imageName, ext));

                        sqlCommand.Parameters.AddWithValue("@imagePath", uploadImagePath+imageName);
                        sqlCommand.Parameters.AddWithValue("@imageThumb", uploadThumbPath+imageName);
                        sqlCommand.Parameters.AddWithValue("@galleryId", idGallery);

                        connComic.Open();
                        sqlCommand.ExecuteNonQuery();

                        LabelUploadError.Text = "Upload succeeded!";
                    }
                    catch(Exception exc)
                    {
                        throw exc;
                    }
                    finally
                    {
                        connComic.Close();
                    }
                }
                else
                {
                    LabelUploadError.Text = "Invalid format";
                }
            }
        }

        //Custom
        public bool ThumbnailCallback()
        {
            return false;
        }

        public void GetThumbnailImage(PaintEventArgs e)
        {
            System.Drawing.Image.GetThumbnailImageAbort myCallback =
            new System.Drawing.Image.GetThumbnailImageAbort(ThumbnailCallback);
            Bitmap myBitmap = new Bitmap("Climber.jpg");
            System.Drawing.Image myThumbnail = myBitmap.GetThumbnailImage(
            40, 40, myCallback, IntPtr.Zero);
            e.Graphics.DrawImage(myThumbnail, 150, 75);
        }


        private HtmlGenericControl CreateDiv(string divId)
        {
            HtmlGenericControl div = new HtmlGenericControl("div");
            div.Attributes.Add("id", divId);
            return div;
        }

    }
}
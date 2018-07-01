using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Comics.Panel
{
    public partial class PanelImage : System.Web.UI.Page
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
            else
            {
                Response.BufferOutput = true;
                Response.Redirect("~/Default.aspx");
            }
        }

        protected void btnUpload_Click(object sender, EventArgs e)
        {
            if (FileUploadImage.HasFile)
            {
                if (FileUploadImage.PostedFile.ContentType == "image/jpg" ||
                    FileUploadImage.PostedFile.ContentType == "image/jpeg" ||
                    FileUploadImage.PostedFile.ContentType == "image/png")
                {
                    int idGallery = Int32.Parse(DropDownListSetGallery.SelectedValue);

                    string imageFileName = FileUploadImage.PostedFile.FileName;
                    string imageSafeFileName = Path.GetFileNameWithoutExtension(imageFileName);
                    string imageExtension = Path.GetExtension(imageFileName);
                    Int32 intTimestamp = (Int32)(DateTime.UtcNow.Subtract(new DateTime(1970, 1, 1))).TotalSeconds;
                    string timestamp = intTimestamp.ToString();

                    char[] toTrim = { '.' };
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
                        FileUploadImage.SaveAs(Server.MapPath(uploadImagePath) + imageName);

                        System.Drawing.Image i = System.Drawing.Image.FromFile(Server.MapPath(uploadImagePath) + imageName);
                        System.Drawing.Image thumb = i.GetThumbnailImage(150, 150, () => false, IntPtr.Zero);
                        thumb.Save(Path.ChangeExtension(Server.MapPath(uploadThumbPath) + imageName, ext));

                        sqlCommand.Parameters.AddWithValue("@imagePath", uploadImagePath + imageName);
                        sqlCommand.Parameters.AddWithValue("@imageThumb", uploadThumbPath + imageName);
                        sqlCommand.Parameters.AddWithValue("@galleryId", idGallery);

                        connComic.Open();
                        sqlCommand.ExecuteNonQuery();

                        LabelUploadError.Text = "Upload succeeded!";
                    }
                    catch (Exception exc)
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


        protected void GridViewImage_RowEditing(object sender, GridViewEditEventArgs e)
        {
            GridViewImage.EditIndex = e.NewEditIndex;

        }

        protected void GridViewImage_RowDeleting(object sender, GridViewDeleteEventArgs e)
        {
            Image slikaBrisanje = (Image)GridViewImage.Rows[e.RowIndex].FindControl("Slika");

            string staraSlika = slikaBrisanje.ImageUrl;
            FileInfo info = new FileInfo(Server.MapPath(staraSlika));

            if(info.Exists)
            {
                File.Delete(Server.MapPath(staraSlika));
            }

        }

        protected void GridViewImage_RowDataBound(object sender, GridViewRowEventArgs e)
        {
            Label idGallerija = (Label)e.Row.FindControl("LabelGallery");
            DropDownList ddlGallery = (DropDownList)e.Row.FindControl("DropDownListGallery");

            if (idGallerija != null && ddlGallery != null)
            {
                ddlGallery.SelectedValue = idGallerija.Text;
            }

        }

        protected void GridViewImage_RowUpdating(object sender, GridViewUpdateEventArgs e)
        {
            string folderUpload = Server.MapPath("~/assets/images/");
            FileUpload novaSlika = (FileUpload)GridViewImage.Rows[e.RowIndex].FindControl("FileUploadImage");

            Image img = (Image)GridViewImage.Rows[e.RowIndex].FindControl("Slika");
            
            if(novaSlika != null && novaSlika.HasFile && novaSlika.FileName != "")
            {
                string stara = img.ImageUrl;
                FileInfo podaci = new FileInfo(Server.MapPath(stara));

                if(podaci.Exists)
                {
                    File.Delete(Server.MapPath(stara));
                }

                string fileName = novaSlika.PostedFile.FileName;
                string imageSafeFileName = Path.GetFileNameWithoutExtension(fileName);
                string imageExtension = Path.GetExtension(fileName);
                Int32 intTimestamp = (Int32)(DateTime.UtcNow.Subtract(new DateTime(1970, 1, 1))).TotalSeconds;
                string timestamp = intTimestamp.ToString();

                char[] toTrim = { '.' };
                string ext = imageExtension.Trim(toTrim);

                string imageName = String.Format("{0}{1}{2}", imageSafeFileName, timestamp, imageExtension);

                novaSlika.SaveAs(folderUpload + imageName);
                e.NewValues["imagePath"] = "~/assets/images/" + imageName;
            }
            else
            {
                e.NewValues["imagePath"] = img.ImageUrl;
            }
            DropDownList listaGallerija = (DropDownList)GridViewImage.Rows[e.RowIndex].FindControl("DropDownListGallery");
            e.NewValues["galleryId"] = listaGallerija.SelectedValue;

            Label labelThumb = (Label)GridViewImage.Rows[e.RowIndex].FindControl("LabelThumb");
            e.NewValues["imageThumb"] = labelThumb.Text;

        }




    }
}
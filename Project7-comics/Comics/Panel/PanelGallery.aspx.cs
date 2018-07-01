using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Comics.Panel
{
    public partial class PanelGallery : System.Web.UI.Page
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

        protected void ButtonInsertGallery_Click(object sender, EventArgs e)
        {
            string galleryName = TextBoxGallery.Text;
            TextBoxGallery.Text = string.Empty;

            string query = "insert into [Gallery] ([galleryName]) values (@galleryName)";
            string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic = new SqlConnection(strComic);
            SqlCommand sqlCommand = new SqlCommand(query, connComic);

            sqlCommand.Parameters.AddWithValue("@galleryName", galleryName);

            connComic.Open();
            sqlCommand.ExecuteNonQuery();
            connComic.Close();

            LabelSuccess.Text = "Insert worked!";

            GridViewGallery.DataBind();
        }
    }
}
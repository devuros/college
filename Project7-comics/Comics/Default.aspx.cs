using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Comics
{
    public partial class Default : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if(User.Identity.IsAuthenticated)
            {
                string user = Membership.GetUser().ToString();

                HyperLinkProfile.Text = user;
                HyperLinkProfile.NavigateUrl = "~/Profile.aspx";
                HyperLinkProfile.Visible = true;

                HyperLinkCart.Text = "<i class='fa fa-shopping-cart'></i>";
                HyperLinkCart.NavigateUrl = "~/Cart.aspx";
                HyperLinkCart.Visible = true;
            }

            string divItem = "";

            string query = "SELECT * FROM Category";
            string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic = new SqlConnection(strComic);
            SqlCommand sqlCommand = new SqlCommand(query, connComic);

            DataTable dataCategory = new DataTable();
            SqlDataAdapter adapterCategory = new SqlDataAdapter(sqlCommand);
            adapterCategory.Fill(dataCategory);

            foreach (DataRow rowCategory in dataCategory.Rows)
            {
                string idCategory = rowCategory["IdCategory"].ToString();
                string name = rowCategory["name"].ToString();
                string path = rowCategory["path"].ToString();
                string description = rowCategory["description"].ToString();

                divItem += "<div class='item'>";
                divItem += "<a href='Category.aspx?idCategory=" + idCategory + "'>";
                divItem += "<img src='"+ path +"' />";
                divItem += "</a><a href='Category.aspx?idCategory="+ idCategory +"'><h4>"+ name +"</h4></a>";
                divItem += "<p>"+ description +"</p>";
                divItem += "</div>";

                div_Category.InnerHtml = divItem;
            }
        }
    }
}
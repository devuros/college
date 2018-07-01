using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;

namespace Comics
{
    public partial class Category : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            bool cactus_log = false;

            if (User.Identity.IsAuthenticated)
            {
                string user = Membership.GetUser().ToString();

                HyperLinkProfile.Text = user;
                HyperLinkProfile.NavigateUrl = "~/Profile.aspx";
                HyperLinkProfile.Visible = true;

                HyperLinkCart.Text = "<i class='fa fa-shopping-cart'></i>";
                HyperLinkCart.NavigateUrl = "~/Cart.aspx";
                HyperLinkCart.Visible = true;

                cactus_log = true;
            }

            string getId = Request.QueryString["idCategory"];

            //Title
            string query2 = "SELECT * FROM Category WHERE idCategory = '" + getId + "'";
            string strComic2 = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic2 = new SqlConnection(strComic2);
            SqlCommand sqlCommand2 = new SqlCommand(query2, connComic2);

            DataTable dataCategory2 = new DataTable();
            SqlDataAdapter adapterCategory2 = new SqlDataAdapter(sqlCommand2);
            adapterCategory2.Fill(dataCategory2);

            foreach (DataRow rowCategory2 in dataCategory2.Rows)
            {
                string title = rowCategory2["name"].ToString();

                h2_tag.InnerText = title;
            }

            //Products
            string query = "SELECT * FROM Product WHERE idCategory = '" + getId + "'";
            string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic = new SqlConnection(strComic);
            SqlCommand sqlCommand = new SqlCommand(query, connComic);

            DataTable dataCategory = new DataTable();
            SqlDataAdapter adapterCategory = new SqlDataAdapter(sqlCommand);
            adapterCategory.Fill(dataCategory);

            HtmlGenericControl prikazItemWrapper;
            HtmlGenericControl prikazItem;
            HtmlGenericControl prikazCart;

            foreach (DataRow rowCategory in dataCategory.Rows)
            {
                string idProduct = rowCategory["IdProduct"].ToString();
                string idCategory = rowCategory["idCategory"].ToString();
                string productName = rowCategory["productName"].ToString();
                string productImage = rowCategory["productImage"].ToString();
                string author = rowCategory["author"].ToString();
                string price = rowCategory["price"].ToString();
                string details = rowCategory["details"].ToString();

                //prikazItem
                prikazItem = CreateDiv("prikaz_item");
                prikazItem.Attributes["class"] = "prikaz-item";

                HyperLink linkImage = new HyperLink();
                linkImage.NavigateUrl = "#";
                linkImage.ImageUrl = productImage;
                linkImage.Attributes["data-product"] = idProduct;

                HyperLink linkH = new HyperLink();
                linkH.NavigateUrl = "#";
                linkH.Text = "<h4>" + productName + "</h4>";
                linkH.Attributes["data-product"] = idProduct;

                prikazItem.Controls.Add(linkImage);
                prikazItem.Controls.Add(linkH);

                //prikazCart
                prikazCart = CreateDiv("prikaz_cart");
                prikazCart.Attributes["class"] = "prikaz-cart";

                prikazCart.InnerHtml += "<p class='center'>Price: " + price + "</p>";

                if (cactus_log) {
                    HyperLink linkCart = new HyperLink();
                    linkCart.NavigateUrl = "~/Cart.aspx?idProduct=" + idProduct;
                    linkCart.Text = "Add to cart";
                    HtmlGenericControl para = new HtmlGenericControl("p");
                    para.Attributes["class"] = "right";
                    para.Controls.Add(linkCart);
                    prikazCart.Controls.Add(para);
                }
                else {
                    prikazCart.InnerHtml += "<p class='right'>Login to buy</p>";
                }

                //prikazItemWrapper
                prikazItemWrapper = CreateDiv("prikaz_item_wrapper");
                prikazItemWrapper.Attributes["class"] = "prikaz-item-wrapper";

                prikazItemWrapper.Controls.Add(prikazItem);
                prikazItemWrapper.Controls.Add(prikazCart);

                PlaceHolderProducts.Controls.Add(prikazItemWrapper);
            }
        }

        //KIDA
        private HtmlGenericControl CreateDiv(string divId)
        {
            HtmlGenericControl div = new HtmlGenericControl("div");
            div.Attributes.Add("id", divId);
            return div;
        }

    }
}
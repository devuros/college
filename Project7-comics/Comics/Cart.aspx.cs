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
    public partial class Cart : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (User.Identity.IsAuthenticated)
            {
                string user = Membership.GetUser().ToString();
                MembershipUser muser = Membership.GetUser();

                HyperLinkProfile.Text = user;
                HyperLinkProfile.NavigateUrl = "~/Profile.aspx";
                HyperLinkProfile.Visible = true;

                HyperLinkCart.Text = "<i class='fa fa-shopping-cart'></i>";
                HyperLinkCart.NavigateUrl = "~/Cart.aspx";
                HyperLinkCart.Visible = true;

                //RemoveProduct
                string idRemove = Request.QueryString["idRemove"];

                if (idRemove != null)
                {
                    string query4 = "DELETE FROM [Cart] WHERE [Cart].[IdCart] = @idRemove";
                    string strComic4 = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
                    SqlConnection connComic4 = new SqlConnection(strComic4);
                    SqlCommand sqlCommand4 = new SqlCommand(query4, connComic4);

                    sqlCommand4.Parameters.AddWithValue("@idRemove", idRemove);

                    connComic4.Open();
                    sqlCommand4.ExecuteNonQuery();
                    connComic4.Close();
                }

                //AddToCart
                string idProduct = Request.QueryString["idProduct"];

                if (idProduct != null)
                {
                    Int32 intTimestamp = (Int32)(DateTime.UtcNow.Subtract(new DateTime(1970, 1, 1))).TotalSeconds;
                    string timestamp = intTimestamp.ToString();

                    string query = "INSERT INTO [Cart] (idProduct, idUser, time) VALUES (@idProduct, @idUser, @time)";
                    string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
                    SqlConnection connComic = new SqlConnection(strComic);
                    SqlCommand sqlCommand = new SqlCommand(query, connComic);

                    sqlCommand.Parameters.AddWithValue("@idProduct", idProduct);
                    sqlCommand.Parameters.AddWithValue("@idUser", muser.ProviderUserKey);
                    sqlCommand.Parameters.AddWithValue("@time", timestamp);

                    connComic.Open();
                    sqlCommand.ExecuteNonQuery();
                    connComic.Close();
                }

                //DisplayCart
                string query2 = "SELECT * FROM [Cart] JOIN [Product] ON [Cart].[idProduct] = [Product].[IdProduct]"
                    +" JOIN [Category] ON [Product].[idCategory] = [Category].[IdCategory]"
                    +" WHERE [Cart].[idUser] = '" + muser.ProviderUserKey + "'";
                string strComic2 = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
                SqlConnection connComic2 = new SqlConnection(strComic2);
                SqlCommand sqlCommand2 = new SqlCommand(query2, connComic2);

                DataTable dataCategory2 = new DataTable();
                SqlDataAdapter adapterCategory2 = new SqlDataAdapter(sqlCommand2);
                adapterCategory2.Fill(dataCategory2);

                HtmlGenericControl rowProduct;
                HtmlGenericControl productImage;
                HtmlGenericControl productName;
                HtmlGenericControl productCategory;
                HtmlGenericControl productPrice;

                foreach (DataRow rowCategory2 in dataCategory2.Rows)
                {
                    string qIdProduct = rowCategory2["IdProduct"].ToString();
                    string qImage = rowCategory2["productImage"].ToString();
                    string qName = rowCategory2["productName"].ToString();
                    string qCategory = rowCategory2["name"].ToString();
                    string qPrice = rowCategory2["price"].ToString();
                    string qCart = rowCategory2["IdCart"].ToString();

                    productPrice = CreateDiv("product-price");
                    productPrice.Attributes["class"] = "product-price";
                    HyperLink linkRemove = new HyperLink();
                    linkRemove.NavigateUrl = "~/Cart.aspx?idRemove=" + qCart;
                    linkRemove.Text = "Remove";
                    HtmlGenericControl productPriceP = new HtmlGenericControl("p");
                    productPriceP.InnerHtml = qPrice + ",00 $<br/>";
                    productPriceP.Controls.Add(linkRemove);
                    productPrice.Controls.Add(productPriceP);

                    productCategory = CreateDiv("product-category");
                    productCategory.Attributes["class"] = "product-category";
                    HtmlGenericControl productCategoryP = new HtmlGenericControl("p");
                    productCategoryP.InnerText = qCategory;
                    productCategory.Controls.Add(productCategoryP);

                    productName = CreateDiv("product-name");
                    productName.Attributes["class"] = "product-name";
                    HtmlGenericControl productNameP = new HtmlGenericControl("p");
                    productNameP.InnerText = qName;
                    productName.Controls.Add(productNameP);

                    productImage = CreateDiv("product-image");
                    productImage.Attributes["class"] = "product-image";
                    Image imgp = new Image();
                    imgp.ImageUrl = qImage;
                    productImage.Controls.Add(imgp);

                    rowProduct = CreateDiv("row-product");
                    rowProduct.Attributes["class"] = "row-product";

                    rowProduct.Controls.Add(productImage);
                    rowProduct.Controls.Add(productName);
                    rowProduct.Controls.Add(productCategory);
                    rowProduct.Controls.Add(productPrice);

                    PlaceHolderItems.Controls.Add(rowProduct);
                }

                //Subtotal
                string query3 = "SELECT SUM(price) AS subtotal"
                    + " FROM [Product] JOIN [Cart] ON [Cart].[idProduct] = [Product].[IdProduct]"
                    + " WHERE [Cart].[idUser] = '" + muser.ProviderUserKey + "'";
                string strComic3 = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
                SqlConnection connComic3 = new SqlConnection(strComic3);
                SqlCommand sqlCommand3 = new SqlCommand(query3, connComic3);

                DataTable dataCategory3 = new DataTable();
                SqlDataAdapter adapterCategory3 = new SqlDataAdapter(sqlCommand3);
                adapterCategory3.Fill(dataCategory3);

                DataRow rc = dataCategory3.Rows[0];
                string subtotal = rc["subtotal"].ToString();
                Label labelSubtotal = new Label();

                //if is null
                if (subtotal == "")
                {
                    Label labelEmpty = new Label();
                    labelEmpty.Text = "Your cart is empty";
                    PlaceHolderMessage.Controls.Add(labelEmpty);
                    labelSubtotal.Text = "0,-- $<br/>";
                }
                else
                {
                    labelSubtotal.Text = subtotal + ",00 $ <br/>";
                    ButtonPurchase.Enabled = true;
                    ButtonPurchase.Visible = true;
                }
                PlaceHolderSubtotal.Controls.Add(labelSubtotal);

                //
                string triumph = Request.QueryString["purchase"];
                if (triumph == "yes")
                {
                    Label labelTriumph = new Label();
                    labelTriumph.Text = "Successful purchase";
                    PlaceHolderMessage.Controls.Clear();
                    PlaceHolderMessage.Controls.Add(labelTriumph);
                }

            }
            else
            {
                Response.BufferOutput = true;
                Response.Redirect("~/Default.aspx");
            }
        }

        private HtmlGenericControl CreateDiv(string divId)
        {
            HtmlGenericControl div = new HtmlGenericControl("div");
            div.Attributes.Add("id", divId);
            return div;
        }

        protected void ButtonPurchase_Click(object sender, EventArgs e)
        {
            MembershipUser muser = Membership.GetUser();

            string query5 = "DELETE FROM [Cart] WHERE [Cart].[idUser] = @muser";
            string strComic5 = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic5 = new SqlConnection(strComic5);
            SqlCommand sqlCommand5 = new SqlCommand(query5, connComic5);

            sqlCommand5.Parameters.AddWithValue("@muser", muser.ProviderUserKey);

            connComic5.Open();
            sqlCommand5.ExecuteNonQuery();
            connComic5.Close();

            Response.BufferOutput = true;
            Response.Redirect("~/Cart.aspx?purchase=yes");
        }

    }
}
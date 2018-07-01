using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Comics.Panel
{
    public partial class PanelProduct : System.Web.UI.Page
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

        protected void GridViewProduct_RowDataBound(object sender, GridViewRowEventArgs e)
        {
            Label labelCategory = (Label)e.Row.FindControl("LabelSelectCategory");
            DropDownList ddlCategory = (DropDownList)e.Row.FindControl("DropDownListSelectCategory");

            if(labelCategory != null && ddlCategory != null)
            {
                ddlCategory.SelectedValue = labelCategory.Text;
            }

            if (e.Row.RowType != DataControlRowType.DataRow)
            {
                return;
            }

            Label labelImage = (Label)e.Row.FindControl("LabelSelectImage");
            Image img = (Image)e.Row.FindControl("ImageSelectImage");

            string put = labelImage.Text;
            put = "~/" + put;
            img.ImageUrl = put;

        }



    }
}
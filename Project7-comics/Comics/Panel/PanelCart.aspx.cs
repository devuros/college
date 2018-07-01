using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Comics.Panel
{
    public partial class PanelCart : System.Web.UI.Page
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

        protected void GridViewCart_RowEditing(object sender, GridViewEditEventArgs e)
        {
            GridViewCart.EditIndex = e.NewEditIndex;
        }

        protected void GridViewCart_Load(object sender, EventArgs e)
        {
        }

        protected void GridViewCart_PreRender(object sender, EventArgs e)
        {
        }

        protected void GridViewCart_RowDataBound(object sender, GridViewRowEventArgs e)
        {
            //pravi neku razliku?
            if (e.Row.RowType != DataControlRowType.DataRow)
            {
                return;
            }
            
            //1 497 266 303
            Label timestamp = (Label)e.Row.FindControl("LabelTime");
            Label datetime = (Label)e.Row.FindControl("LabelDateTime");

            long ss = Convert.ToInt64(timestamp.Text);
            DateTime sss = FromUnixTime(ss);
            datetime.Text = sss.ToString();
        }


        public static DateTime FromUnixTime(long unixTime)
        {
            var epoch = new DateTime(1970, 1, 1, 0, 0, 0, DateTimeKind.Utc);
            return epoch.AddSeconds(unixTime);
        }

    }
}
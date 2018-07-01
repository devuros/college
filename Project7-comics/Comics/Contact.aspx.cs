using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Mail;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Comics
{
    public partial class Contact : System.Web.UI.Page
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
        }

        protected void btnSend_Click(object sender, EventArgs e)
        {
            if(this.Page.IsValid)
            {
                string name = tbName.Text;
                string email = tbEmail.Text;
                string message = tbMessage.Text;

                //Fake mail
                SmtpClient client = new SmtpClient();

                MailMessage mail = new MailMessage();
                mail.From = new MailAddress(email);
                mail.To.Add(new MailAddress("uros@gmail.com"));
                mail.Body = message;

                //client.Send(mail);
                tbName.Text = string.Empty;
                tbEmail.Text = string.Empty;
                tbMessage.Text = string.Empty;

                div_success.InnerText = "Thank you for your feedback!";
            }

        }
    }
}
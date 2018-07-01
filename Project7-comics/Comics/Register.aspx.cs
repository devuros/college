using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Comics
{
    public partial class Register : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            CreateUserWizardRegister.Visible = true;
            
            if(User.Identity.IsAuthenticated)
            {
                CreateUserWizardRegister.Visible = false;
            }
        }

        protected void CreateUserWizardRegister_CreatedUser(object sender, EventArgs e)
        {
            TextBox username = (TextBox)CreateUserWizardRegister.CreateUserStep.ContentTemplateContainer.FindControl("UserName");
            TextBox firstName = (TextBox)CreateUserWizardRegister.CreateUserStep.ContentTemplateContainer.FindControl("tbFirstName");
            TextBox lastName = (TextBox)CreateUserWizardRegister.CreateUserStep.ContentTemplateContainer.FindControl("tbLastName");
            DropDownList gender = (DropDownList)CreateUserWizardRegister.CreateUserStep.ContentTemplateContainer.FindControl("DropDownListGender");

            string query = "INSERT INTO Userext (Id, name, lastName, gender) VALUES (@Id, @name, @lastName, @gender)";
            string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic = new SqlConnection(strComic);
            SqlCommand sqlCommand = new SqlCommand(query, connComic);

            try
            {
                MembershipUser muser = Membership.GetUser(username.Text);
                
                if(muser != null)
                {
                    sqlCommand.Parameters.AddWithValue("@Id", muser.ProviderUserKey);
                    sqlCommand.Parameters.AddWithValue("@name", firstName.Text);
                    sqlCommand.Parameters.AddWithValue("@lastName", lastName.Text);
                    sqlCommand.Parameters.AddWithValue("@gender", gender.SelectedItem.Text);

                    connComic.Open();
                    sqlCommand.ExecuteNonQuery();
                }

            }
            catch (Exception ex)
            {
                throw ex;
            }
            finally
            {
                connComic.Close();
            }
        }
    }
}
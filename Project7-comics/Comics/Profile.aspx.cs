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
    public partial class Profile : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (User.Identity.IsAuthenticated)
            {
                string unique = Membership.GetUser().ProviderUserKey.ToString();

                string query = "SELECT * FROM [Userext] WHERE [Userext].[Id] = '"+ unique +"'";
                string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
                SqlConnection connComic = new SqlConnection(strComic);
                SqlCommand sqlCommand = new SqlCommand(query, connComic);

                DataTable dataCategory = new DataTable();
                SqlDataAdapter adapterCategory = new SqlDataAdapter(sqlCommand);
                adapterCategory.Fill(dataCategory);

                foreach (DataRow rowCategory in dataCategory.Rows)
                {
                    string name = rowCategory["name"].ToString();
                    string lastName = rowCategory["lastName"].ToString();
                    string gender = rowCategory["gender"].ToString();

                    TextBoxFirstName.Text = name;
                    TextBoxLastName.Text = lastName;
                    TextBoxGender.Text = gender;
                }
            }
            else
            {
                Response.BufferOutput = true;
                Response.Redirect("~/Default.aspx");
            }
        }
    }
}
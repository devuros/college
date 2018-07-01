using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.Script.Serialization;
using System.Web.Services;

namespace Comics
{
    /// <summary>
    /// Summary description for RemoteRequest
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line. 
    // [System.Web.Script.Services.ScriptService]
    public class RemoteRequest : System.Web.Services.WebService
    {
        #region HelloWorld
        [WebMethod]
        public string HelloWorld()
        {
            return "Hello World";
        }
        #endregion

        [WebMethod]
        public void ProductDetails(string idProduct)
        {
            string query = "SELECT * FROM [Product] WHERE [Product].[IdProduct] = @idProduct";
            string strComic = WebConfigurationManager.ConnectionStrings["strComic"].ConnectionString;
            SqlConnection connComic = new SqlConnection(strComic);
            SqlCommand sqlCommand = new SqlCommand(query, connComic);

            sqlCommand.Parameters.AddWithValue("@idProduct", idProduct);

            try
            {
                connComic.Open();

                DataTable dataCategory = new DataTable();
                SqlDataAdapter adapterCategory = new SqlDataAdapter(sqlCommand);
                adapterCategory.Fill(dataCategory);

                List<string> lista = new List<string>();
                lista.Clear();

                foreach (DataRow rowCategory in dataCategory.Rows)
                {
                    string name = rowCategory["productName"].ToString();
                    string image = rowCategory["productImage"].ToString();
                    string author = rowCategory["author"].ToString();
                    string details = rowCategory["details"].ToString();

                    string all = "<img src='"+ image +"'><h4>"+ name +"</h4>"
                        +"<p>"+ details +"</p>"+"<p><br/>Author: "+ author +"</p>";

                    lista.Add(all);
                    var obj = new JavaScriptSerializer().Serialize(lista);
                    lista.Clear();

                    this.Context.Response.ContentType = "application/json; charset=utf-8";
                    this.Context.Response.Write(obj);
                }
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

    }
}

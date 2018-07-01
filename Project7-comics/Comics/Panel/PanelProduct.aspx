<%@ Page Title="Panel product" Language="C#" MasterPageFile="~/masters/PanelTemp.Master" AutoEventWireup="true" CodeBehind="PanelProduct.aspx.cs" Inherits="Comics.Panel.PanelProduct" %>
<asp:Content ID="Content1" ContentPlaceHolderID="cphHead" runat="server">
    <%-- Head --%>

</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="cphLogin" runat="server">
    <%-- Login --%>
    <div class='login-link'>
        <asp:HyperLink ID="HyperLinkProfile" runat="server" Visible="false"></asp:HyperLink>
    </div>
    <div class='login-link cart'>
        <asp:HyperLink ID="HyperLinkCart" runat="server" Visible="false"></asp:HyperLink>
    </div>

</asp:Content>
<asp:Content ID="Content3" ContentPlaceHolderID="cphMain" runat="server">
    <%-- Main --%>

    <div class="total-width">
        <div class="panel-wrapper site-width middle">
            <div class="panel-left">
                
                <%-- SqlDataSource --%>
                <asp:SqlDataSource ID="SqlDataSourceProduct" runat="server" 
                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                    DeleteCommand="DELETE FROM [Product] WHERE [IdProduct] = @IdProduct" 
                    InsertCommand="INSERT INTO [Product] ([idCategory], [productName], [productImage], [author], [price], [details]) VALUES (@idCategory, @productName, @productImage, @author, @price, @details)" 
                    SelectCommand="SELECT * FROM [Product]" 
                    UpdateCommand="UPDATE [Product] SET [idCategory] = @idCategory, [productName] = @productName, [productImage] = @productImage, [author] = @author, [price] = @price, [details] = @details WHERE [IdProduct] = @IdProduct">
                    <DeleteParameters>
                        <asp:Parameter Name="IdProduct" Type="Int32"></asp:Parameter>
                    </DeleteParameters>
                    <InsertParameters>
                        <asp:Parameter Name="idCategory" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="productName" Type="String"></asp:Parameter>
                        <asp:Parameter Name="productImage" Type="String"></asp:Parameter>
                        <asp:Parameter Name="author" Type="String"></asp:Parameter>
                        <asp:Parameter Name="price" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="details" Type="String"></asp:Parameter>
                    </InsertParameters>
                    <UpdateParameters>
                        <asp:Parameter Name="idCategory" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="productName" Type="String"></asp:Parameter>
                        <asp:Parameter Name="productImage" Type="String"></asp:Parameter>
                        <asp:Parameter Name="author" Type="String"></asp:Parameter>
                        <asp:Parameter Name="price" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="details" Type="String"></asp:Parameter>
                        <asp:Parameter Name="IdProduct" Type="Int32"></asp:Parameter>
                    </UpdateParameters>
                </asp:SqlDataSource>

                <h2>All products</h2>
                <%-- GridView --%>
                <asp:GridView ID="GridViewProduct" runat="server" CellPadding="4" ForeColor="#333333" 
                    GridLines="None" AutoGenerateColumns="False" DataKeyNames="IdProduct" 
                    DataSourceID="SqlDataSourceProduct" AllowPaging="True" PageSize="5" OnRowDataBound="GridViewProduct_RowDataBound">
                    <AlternatingRowStyle BackColor="White" ForeColor="#284775"></AlternatingRowStyle>

                    <Columns>
                        <asp:CommandField ShowEditButton="True" ShowDeleteButton="True"></asp:CommandField>
                        <asp:BoundField DataField="IdProduct" HeaderText="IdProduct" ReadOnly="True" InsertVisible="False" SortExpression="IdProduct"></asp:BoundField>
                        <asp:TemplateField HeaderText="Category">
                            <ItemTemplate>
                                <asp:SqlDataSource ID="SqlDataSourceSelectCategory" runat="server" ConnectionString='<%$ ConnectionStrings:strComic %>' SelectCommand="SELECT * FROM [Category]"></asp:SqlDataSource>
                                <asp:DropDownList ID="DropDownListSelectCategory" runat="server"
                                    Enabled="false" DataSourceID="SqlDataSourceSelectCategory" DataTextField="name" DataValueField="IdCategory">
                                </asp:DropDownList>
                                <asp:Label ID="LabelSelectCategory" Visible="false" runat="server" Text='<%# Bind("idCategory") %>'></asp:Label>
                            </ItemTemplate>
                        </asp:TemplateField>
                        <asp:BoundField DataField="productName" HeaderText="productName" SortExpression="productName"></asp:BoundField>
                        
                        <asp:TemplateField HeaderText="Image">
                            <ItemTemplate>
                                <asp:Label ID="LabelSelectImage" runat="server" Text='<%# Bind("productImage") %>' 
                                    Visible="false"></asp:Label>
                                <asp:Image ID="ImageSelectImage" runat="server" 
                                    Width="50" Height="50"/>
                            </ItemTemplate>
                        </asp:TemplateField>

                        <asp:BoundField DataField="author" HeaderText="author" SortExpression="author"></asp:BoundField>
                        <asp:BoundField DataField="price" HeaderText="price" SortExpression="price"></asp:BoundField>
                        <asp:BoundField DataField="details" HeaderText="details" SortExpression="details"></asp:BoundField>
                    </Columns>

                    <EditRowStyle BackColor="#999999"></EditRowStyle>
                    <FooterStyle BackColor="#5D7B9D" Font-Bold="True" ForeColor="White"></FooterStyle>
                    <HeaderStyle BackColor="#5D7B9D" Font-Bold="True" ForeColor="White"></HeaderStyle>
                    <PagerStyle HorizontalAlign="Center" BackColor="#284775" ForeColor="White"></PagerStyle>
                    <RowStyle BackColor="#F7F6F3" ForeColor="#333333"></RowStyle>
                    <SelectedRowStyle BackColor="#E2DED6" Font-Bold="True" ForeColor="#333333"></SelectedRowStyle>
                    <SortedAscendingCellStyle BackColor="#E9E7E2"></SortedAscendingCellStyle>
                    <SortedAscendingHeaderStyle BackColor="#506C8C"></SortedAscendingHeaderStyle>
                    <SortedDescendingCellStyle BackColor="#FFFDF8"></SortedDescendingCellStyle>
                    <SortedDescendingHeaderStyle BackColor="#6F8DAE"></SortedDescendingHeaderStyle>
                </asp:GridView>
                
            </div>
            <div class="panel-right">
                <h4>Insert product</h4>
                <%-- Insert product --%>
                <asp:SqlDataSource ID="SqlDataSourceInsertCategory" runat="server" 
                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                    SelectCommand="SELECT * FROM [Category]"></asp:SqlDataSource>

                <table style="width: 100%;">
                    <tr>
                        <td>
                            <asp:Label ID="LabelInsertCategory" runat="server" Text="Category:"></asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" 
                                ErrorMessage="RequiredFieldValidator" ValidationGroup="pi" ControlToValidate="DropDownListInsertCategory" InitialValue="0">*</asp:RequiredFieldValidator>
                        </td>
                        <td>
                            <asp:DropDownList ID="DropDownListInsertCategory" runat="server" 
                                AppendDataBoundItems="true" DataSourceID="SqlDataSourceInsertCategory" 
                                DataTextField="name" DataValueField="IdCategory" ValidationGroup="pi">
                                <asp:ListItem Value="0">Choose...</asp:ListItem>
                            </asp:DropDownList>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="LabelInsertImage" runat="server" Text="Image:"></asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidator2" runat="server" ErrorMessage="RequiredFieldValidator"
                                ValidationGroup="pi" ControlToValidate="FileUploadInsertImage">*</asp:RequiredFieldValidator>
                        </td>
                        <td>
                            <asp:FileUpload ID="FileUploadInsertImage" runat="server" ValidationGroup="pi" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="LabelInsertName" runat="server" Text="Name:"></asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidator3" runat="server" ErrorMessage="RequiredFieldValidator"
                                ValidationGroup="pi" ControlToValidate="TextBoxInsertName">*</asp:RequiredFieldValidator>
                        </td>
                        <td>
                            <asp:TextBox ID="TextBoxInsertName" runat="server" ValidationGroup="pi"></asp:TextBox>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="LabelInsertAuthor" runat="server" Text="Author:"></asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidator4" runat="server" ErrorMessage="RequiredFieldValidator"
                                ValidationGroup="pi" ControlToValidate="TextBoxInsertAuthor">*</asp:RequiredFieldValidator>
                        </td>
                        <td>
                            <asp:TextBox ID="TextBoxInsertAuthor" runat="server" ValidationGroup="pi"></asp:TextBox>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="LabelInsertPrice" runat="server" Text="Price:"></asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidator5" runat="server" ErrorMessage="RequiredFieldValidator"
                                ValidationGroup="pi" ControlToValidate="TextBoxInsertPrice">*</asp:RequiredFieldValidator>
                        </td>
                        <td>
                            <asp:TextBox ID="TextBoxInsertPrice" runat="server" ValidationGroup="pi"></asp:TextBox>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="LabelInsertDetails" runat="server" Text="Details:"></asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidator6" runat="server" ErrorMessage="RequiredFieldValidator"
                                ValidationGroup="pi" ControlToValidate="TextBoxInsertDetails">*</asp:RequiredFieldValidator>
                        </td>
                        <td>
                            <asp:TextBox ID="TextBoxInsertDetails" runat="server" 
                                TextMode="MultiLine" ValidationGroup="pi"></asp:TextBox>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <asp:Button ID="ButtonInsertProduct" runat="server" Text="Insert" ValidationGroup="pi" />
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</asp:Content>
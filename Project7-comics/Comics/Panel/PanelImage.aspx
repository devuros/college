<%@ Page Title="Panel Image" Language="C#" MasterPageFile="~/masters/PanelTemp.Master" AutoEventWireup="true" CodeBehind="PanelImage.aspx.cs" Inherits="Comics.Panel.PanelImage" %>
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
                
                <asp:SqlDataSource ID="SqlDataSourceImage" runat="server" 
                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                    DeleteCommand="DELETE FROM [Image] WHERE [IdImage] = @IdImage" 
                    InsertCommand="INSERT INTO [Image] ([imagePath], [imageThumb], [galleryId]) VALUES (@imagePath, @imageThumb, @galleryId)" 
                    SelectCommand="SELECT * FROM [Image]" 
                    UpdateCommand="UPDATE [Image] SET [imagePath] = @imagePath, [imageThumb] = @imageThumb, [galleryId] = @galleryId WHERE [IdImage] = @IdImage">
                    <DeleteParameters>
                        <asp:Parameter Name="IdImage" Type="Int32"></asp:Parameter>
                    </DeleteParameters>
                    <InsertParameters>
                        <asp:Parameter Name="imagePath" Type="String"></asp:Parameter>
                        <asp:Parameter Name="imageThumb" Type="String"></asp:Parameter>
                        <asp:Parameter Name="galleryId" Type="Int32"></asp:Parameter>
                    </InsertParameters>
                    <UpdateParameters>
                        <asp:Parameter Name="imagePath" Type="String"></asp:Parameter>
                        <asp:Parameter Name="imageThumb" Type="String"></asp:Parameter>
                        <asp:Parameter Name="galleryId" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="IdImage" Type="Int32"></asp:Parameter>
                    </UpdateParameters>
                </asp:SqlDataSource>
                <asp:SqlDataSource ID="SqlDataSourceInsertGallery" runat="server" 
                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                    SelectCommand="SELECT * FROM [Gallery]"></asp:SqlDataSource>

                <asp:GridView ID="GridViewImage" runat="server" AutoGenerateColumns="False" DataKeyNames="IdImage" DataSourceID="SqlDataSourceImage" CellPadding="4" ForeColor="#333333" GridLines="None" OnRowDataBound="GridViewImage_RowDataBound" OnRowDeleting="GridViewImage_RowDeleting" OnRowEditing="GridViewImage_RowEditing" OnRowUpdating="GridViewImage_RowUpdating">
                    <AlternatingRowStyle BackColor="White" ForeColor="#284775"></AlternatingRowStyle>
                    <Columns>
                        <asp:CommandField ShowEditButton="True" ShowDeleteButton="True"></asp:CommandField>
                        <asp:TemplateField HeaderText="ImagePath">
                            <ItemTemplate>
                                <asp:Image ImageUrl='<%# Bind("imagePath") %>' 
                                    Width="70" Height="70" runat="server" ID="Slika" />
                            </ItemTemplate>
                            <EditItemTemplate>
                                <asp:FileUpload ID="FileUploadImage" runat="server" />
                                <asp:Image ImageUrl='<%# Bind("imagePath") %>' Width="70" Height="70" runat="server" ID="Slika" />
                            </EditItemTemplate>
                        </asp:TemplateField>
                        <asp:TemplateField HeaderText="Gallery">
                            <ItemTemplate>
                                <asp:Label ID="LabelGallery" runat="server" Text='<%# Bind("galleryId") %>' Visible="false"></asp:Label>
                                <asp:DropDownList ID="DropDownListGallery" runat="server" AppendDataBoundItems="true" 
                                    DataSourceID="SqlDataSourceGallery" 
                                    DataTextField="galleryName" DataValueField="IdGallery" Enabled="false">
                                    <asp:ListItem Value="0">Choose...</asp:ListItem>
                                </asp:DropDownList>
                                <asp:SqlDataSource ID="SqlDataSourceGallery" runat="server"
                                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                                    SelectCommand="SELECT * FROM [Gallery]"></asp:SqlDataSource>

                            </ItemTemplate>
                            <EditItemTemplate>
                                <asp:Label ID="LabelGallery" runat="server" Text='<%# Bind("galleryId") %>' Visible="false">
                                </asp:Label>
                                <asp:DropDownList ID="DropDownListGallery" runat="server" AppendDataBoundItems="true" 
                                    DataSourceID="SqlDataSourceGallery" DataTextField="galleryName" DataValueField="IdGallery">
                                    <asp:ListItem Value="0">Choose...</asp:ListItem>
                                </asp:DropDownList>
                                <asp:SqlDataSource ID="SqlDataSourceGallery" runat="server" 
                                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                                    SelectCommand="SELECT * FROM [Gallery]"></asp:SqlDataSource>

                            </EditItemTemplate>
                        </asp:TemplateField>
                        <asp:TemplateField HeaderText="Thumb">
                            <ItemTemplate>
                                <asp:Label ID="LabelThumb" runat="server" Text='<%# Bind("imageThumb") %>'></asp:Label>
                            </ItemTemplate>
                            <EditItemTemplate>
                                <asp:Label ID="LabelThumb" runat="server" Text='<%# Bind("imageThumb") %>'></asp:Label>
                            </EditItemTemplate>
                        </asp:TemplateField>

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
                <h2>Insert Image</h2>

                <table style="width: 100%;">
                    <tr>
                        <td colspan="2">
                            <h2>Upload your own</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="hideme"></div></td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="LabelImage" runat="server">Image:</asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidatorImage" runat="server" 
                                ErrorMessage="RequiredFieldValidator" ControlToValidate="FileUploadImage" ValidationGroup="gda">*</asp:RequiredFieldValidator>
                        </td>
                        <td>
                            <asp:FileUpload ID="FileUploadImage" runat="server" ValidationGroup="gda" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="hideme"></div></td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="LabelGallery" runat="server">Gallery:</asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidatorGallery" runat="server" 
                                ErrorMessage="RequiredFieldValidator" ValidationGroup="gda"
                                ControlToValidate="DropDownListSetGallery" InitialValue="0">*</asp:RequiredFieldValidator>
                        </td>
                        <td style="text-align: left !important;">
                            <asp:DropDownList ID="DropDownListSetGallery" runat="server" DataSourceID="SqlDataSourceInsertGallery"
                                DataTextField="galleryName" DataValueField="IdGallery" AppendDataBoundItems="true" ValidationGroup="gda">
                                <asp:ListItem Value="0">Choose...</asp:ListItem>
                            </asp:DropDownList>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <asp:Label ID="LabelUploadError" runat="server"></asp:Label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="hideme"></div></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <asp:Button ID="btnUpload" runat="server" Text="Upload" 
                                CssClass="btnUpload" OnClick="btnUpload_Click" ValidationGroup="gda" />
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</asp:Content>
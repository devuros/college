<%@ Page Title="Gallery page" Language="C#" MasterPageFile="~/masters/GeneralTemp.Master" AutoEventWireup="true" CodeBehind="Gallery.aspx.cs" Inherits="Comics.Gallery" %>
<asp:Content ID="Content1" ContentPlaceHolderID="cphHead" runat="server">


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
    <div id="gallery-main-wrapper">
        <div id="gallery-main-top-wrapper" class="total-width">
            <div id="gallery-main-top" class="site-width middle">
                <div id="gallery-main-top-title">
                    <h2>Image collection</h2>
                </div>
                <div id="gallery-main-top-pick">
                    <asp:SqlDataSource ID="SqlDataSourceGallery" runat="server" 
                        ConnectionString='<%$ ConnectionStrings:strComic %>' 
                        SelectCommand="SELECT * FROM [Gallery]"></asp:SqlDataSource>
                    <asp:DropDownList ID="DropDownListGallery" runat="server" DataSourceID="SqlDataSourceGallery" 
                        DataTextField="galleryName" DataValueField="IdGallery" ValidationGroup="pickGallery" ></asp:DropDownList>
                    <asp:Button ID="btnPick" runat="server" Text="Show" ValidationGroup="pickGallery" OnClick="btnPick_Click" />
                </div>
            </div>
        </div>
        <div id="gallery-main-ribbon-wrapper" class="total-width">
            <div id="gallery-main-ribbon" class="site-width middle">
                <div id="gallery-main-ribbon-left">
                    <div id="img-outter">
                        <div id="img-inner">
                            <asp:Image ID="img" runat="server" ImageUrl="~/assets/images/book.jpg" />
                        </div>
                        <strong></strong>
                    </div>
                </div>
                <div id="gallery-main-ribbon-right">
                    <p>
                        Welcome to New site image collections, pick a gallery to display the images inside.
                        You can also upload your favorite photos to our existing galleries. Enjoy your stay
                        dear visitor.
                    </p>
                </div>
            </div>
        </div>
        <div id="gallery-main-bottom-wrapper" class="total-width">
            <div id="gallery-main-bottom" class="site-width middle">
                <div id="gallery-main-bottom-left">
                    <h2>Images</h2>
                    <asp:PlaceHolder ID="PlaceHolderSelectedGallery" runat="server">

                    </asp:PlaceHolder>
                </div>
                <div id="gallery-main-bottom-right">
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
                                    ErrorMessage="RequiredFieldValidator" ControlToValidate="FileUploadImage">*</asp:RequiredFieldValidator>
                            </td>
                            <td>
                                <asp:FileUpload ID="FileUploadImage" runat="server" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><div class="hideme"></div></td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Label ID="LabelGallery" runat="server">Gallery:</asp:Label>
                                <asp:RequiredFieldValidator ID="RequiredFieldValidatorGallery" runat="server" 
                                    ErrorMessage="RequiredFieldValidator" ControlToValidate="DropDownListSetGallery" InitialValue="0">*</asp:RequiredFieldValidator>
                            </td>
                            <td style="text-align: left !important;">
                                <asp:DropDownList ID="DropDownListSetGallery" runat="server" DataSourceID="SqlDataSourceGallery" 
                                    DataTextField="galleryName" DataValueField="IdGallery" AppendDataBoundItems="true">
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
                                    CssClass="btnUpload" OnClick="btnUpload_Click" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</asp:Content>
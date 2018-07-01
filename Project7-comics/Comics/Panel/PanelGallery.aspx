<%@ Page Title="Panel gallery" Language="C#" MasterPageFile="~/masters/PanelTemp.Master" AutoEventWireup="true" CodeBehind="PanelGallery.aspx.cs" Inherits="Comics.Panel.PanelGallery" %>
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

    <asp:SqlDataSource ID="SqlDataSourceGallery" runat="server" 
        ConnectionString='<%$ ConnectionStrings:strComic %>' 
        DeleteCommand="DELETE FROM [Gallery] WHERE [IdGallery] = @IdGallery" 
        InsertCommand="INSERT INTO [Gallery] ([galleryName]) VALUES (@galleryName)" 
        SelectCommand="SELECT * FROM [Gallery]" 
        UpdateCommand="UPDATE [Gallery] SET [galleryName] = @galleryName WHERE [IdGallery] = @IdGallery">
        <DeleteParameters>
            <asp:Parameter Name="IdGallery" Type="Int32"></asp:Parameter>
        </DeleteParameters>
        <InsertParameters>
            <asp:Parameter Name="galleryName" Type="String"></asp:Parameter>
        </InsertParameters>
        <UpdateParameters>
            <asp:Parameter Name="galleryName" Type="String"></asp:Parameter>
            <asp:Parameter Name="IdGallery" Type="Int32"></asp:Parameter>
        </UpdateParameters>
    </asp:SqlDataSource>

    <div class="total-width">
        <div class="panel-wrapper site-width middle">
            <div class="panel-left">
                <asp:GridView ID="GridViewGallery" runat="server" AutoGenerateColumns="False" DataKeyNames="IdGallery" DataSourceID="SqlDataSourceGallery" CellPadding="4" ForeColor="#333333" GridLines="None">
                    <AlternatingRowStyle BackColor="White" ForeColor="#284775"></AlternatingRowStyle>
                    <Columns>
                        <asp:CommandField ShowEditButton="True" ShowDeleteButton="True"></asp:CommandField>
                        <asp:BoundField DataField="galleryName" HeaderText="galleryName" SortExpression="galleryName"></asp:BoundField>
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
                <h2>Insert Gallery</h2>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <asp:Label ID="LabelGallery" runat="server">Gallery:</asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidatorGallery" runat="server" 
                                ErrorMessage="RequiredFieldValidator" ValidationGroup="gal" ControlToValidate="TextBoxGallery">*</asp:RequiredFieldValidator>
                        </td>
                        <td>
                            <asp:TextBox ID="TextBoxGallery" runat="server" ValidationGroup="gal"></asp:TextBox>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <asp:Button ID="ButtonInsertGallery" runat="server" Text="Insert" 
                                ValidationGroup="gal" OnClick="ButtonInsertGallery_Click" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="LabelSuccess" runat="server"></asp:Label>
                        </td>
                        <td></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</asp:Content>
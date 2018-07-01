<%@ Page Title="Panel cart" Language="C#" MasterPageFile="~/masters/PanelTemp.Master" AutoEventWireup="true" CodeBehind="PanelCart.aspx.cs" Inherits="Comics.Panel.PanelCart" %>
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
                
                <asp:SqlDataSource ID="SqlDataSourceCart" runat="server" 
                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                    DeleteCommand="DELETE FROM [Cart] WHERE [IdCart] = @IdCart" 
                    InsertCommand="INSERT INTO [Cart] ([idProduct], [idUser], [time]) VALUES (@idProduct, @idUser, @time)" 
                    SelectCommand="select c.IdCart,p.productName, u.UserName, c.time
                    from [C:\USERS\UKI\DOCUMENTS\VISUAL STUDIO 2013\PROJECTS\COMICS\COMICS\APP_DATA\COMICS_DB.MDF].dbo.Cart c
                    join [C:\USERS\UKI\DOCUMENTS\VISUAL STUDIO 2013\PROJECTS\COMICS\COMICS\APP_DATA\ASPAUDITORNE.MDF].dbo.aspnet_Users u 
                    on c.idUser = u.UserId 
                    JOIN [C:\USERS\UKI\DOCUMENTS\VISUAL STUDIO 2013\PROJECTS\COMICS\COMICS\APP_DATA\COMICS_DB.MDF].dbo.Product p
                    on c.idProduct = p.IdProduct"
                    UpdateCommand="UPDATE [Cart] SET [idProduct] = @idProduct, [idUser] = @idUser, [time] = @time WHERE [IdCart] = @IdCart">
                    <DeleteParameters>
                        <asp:Parameter Name="IdCart" Type="Int32"></asp:Parameter>
                    </DeleteParameters>
                    <InsertParameters>
                        <asp:Parameter Name="idProduct" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="idUser" Type="Object"></asp:Parameter>
                        <asp:Parameter Name="time" Type="String"></asp:Parameter>
                    </InsertParameters>
                    <UpdateParameters>
                        <asp:Parameter Name="idProduct" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="idUser" Type="Object"></asp:Parameter>
                        <asp:Parameter Name="time" Type="String"></asp:Parameter>
                        <asp:Parameter Name="IdCart" Type="Int32"></asp:Parameter>
                    </UpdateParameters>
                </asp:SqlDataSource>

                <h2>All carts content</h2>
                <asp:GridView ID="GridViewCart" runat="server" CellPadding="4" ForeColor="#333333" GridLines="None" AutoGenerateColumns="False" DataKeyNames="IdCart" DataSourceID="SqlDataSourceCart" AllowSorting="True" OnLoad="GridViewCart_Load" OnRowEditing="GridViewCart_RowEditing" OnPreRender="GridViewCart_PreRender" OnRowDataBound="GridViewCart_RowDataBound">
                    <AlternatingRowStyle BackColor="White" ForeColor="#284775"></AlternatingRowStyle>

                    <Columns>
                        <asp:CommandField ShowDeleteButton="True"></asp:CommandField>
                        <asp:TemplateField HeaderText="idProduct">
                            <ItemTemplate>
                                <asp:Label ID="LabelId" runat="server" Text='<%# Bind("IdCart") %>'></asp:Label>
                            </ItemTemplate>
                        </asp:TemplateField>
                        <asp:TemplateField HeaderText="Product">
                            <ItemTemplate>
                                <asp:Label ID="LabelProduct" runat="server" Text='<%# Bind("productName") %>'></asp:Label>
                            </ItemTemplate>
                        </asp:TemplateField>
                        <asp:TemplateField HeaderText="User">
                            <ItemTemplate>
                                <asp:Label ID="LabelUser" runat="server" Text='<%# Bind("UserName") %>'></asp:Label>
                            </ItemTemplate>
                        </asp:TemplateField>
                        <asp:TemplateField HeaderText="Time">
                            <ItemTemplate>
                                <asp:Label ID="LabelTime" runat="server" Text='<%# Bind("time") %>' 
                                    Visible="false"></asp:Label>
                                <asp:Label ID="LabelDateTime" runat="server"></asp:Label>
                            </ItemTemplate>
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
                <h4>It's wrong to add items to other people's carts</h4>
            </div>
        </div>
    </div>

</asp:Content>
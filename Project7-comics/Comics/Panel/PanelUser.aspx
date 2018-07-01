<%@ Page Title="Panel user" Language="C#" MasterPageFile="~/masters/PanelTemp.Master" AutoEventWireup="true" CodeBehind="PanelUser.aspx.cs" Inherits="Comics.Panel.PanelUser" %>
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

    <div class="total-width">
        <div class="panel-wrapper site-width middle">
            <div class="panel-left">
                
                <asp:SqlDataSource ID="SqlDataSourceUser" runat="server" 
                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                    DeleteCommand="DELETE FROM [Userext] WHERE [Id] = @Id" 
                    InsertCommand="INSERT INTO [Userext] ([Id], [name], [lastName], [gender]) VALUES (@Id, @name, @lastName, @gender)" 
                    SelectCommand="select * 
                    from [C:\USERS\UKI\DOCUMENTS\VISUAL STUDIO 2013\PROJECTS\COMICS\COMICS\APP_DATA\COMICS_DB.MDF].dbo.Userext ext
                    join [C:\USERS\UKI\DOCUMENTS\VISUAL STUDIO 2013\PROJECTS\COMICS\COMICS\APP_DATA\ASPAUDITORNE.MDF].dbo.aspnet_Users u 
                    on ext.Id = u.UserId" 
                    UpdateCommand="UPDATE [Userext] SET [name] = @name, [lastName] = @lastName, [gender] = @gender WHERE [Id] = @Id">
                    <DeleteParameters>
                        <asp:Parameter Name="Id" Type="Object"></asp:Parameter>
                    </DeleteParameters>
                    <InsertParameters>
                        <asp:Parameter Name="Id" Type="Object"></asp:Parameter>
                        <asp:Parameter Name="name" Type="String"></asp:Parameter>
                        <asp:Parameter Name="lastName" Type="String"></asp:Parameter>
                        <asp:Parameter Name="gender" Type="String"></asp:Parameter>
                    </InsertParameters>
                    <UpdateParameters>
                        <asp:Parameter Name="name" Type="String"></asp:Parameter>
                        <asp:Parameter Name="lastName" Type="String"></asp:Parameter>
                        <asp:Parameter Name="gender" Type="String"></asp:Parameter>
                        <asp:Parameter Name="Id" Type="Object"></asp:Parameter>
                    </UpdateParameters>
                </asp:SqlDataSource>

                <h2>All application users</h2>
                
                <asp:GridView ID="GridViewUser" runat="server" CellPadding="4" ForeColor="#333333" GridLines="None" AutoGenerateColumns="False" DataKeyNames="Id,ApplicationId,LoweredUserName" DataSourceID="SqlDataSourceUser" OnSelectedIndexChanged="GridViewUser_SelectedIndexChanged">
                    <AlternatingRowStyle BackColor="White" ForeColor="#284775"></AlternatingRowStyle>

                    <Columns>
                        <asp:CommandField ShowSelectButton="True"></asp:CommandField>
                        <asp:BoundField DataField="Id" HeaderText="Id" ReadOnly="True" SortExpression="Id"></asp:BoundField>
                        <asp:BoundField DataField="name" HeaderText="name" SortExpression="name"></asp:BoundField>
                        <asp:BoundField DataField="lastName" HeaderText="lastName" SortExpression="lastName"></asp:BoundField>
                        <asp:BoundField DataField="gender" HeaderText="gender" SortExpression="gender"></asp:BoundField>
                        <asp:BoundField DataField="UserName" HeaderText="UserName" SortExpression="UserName"></asp:BoundField>
                        <asp:BoundField DataField="LastActivityDate" HeaderText="LastActivityDate" SortExpression="LastActivityDate"></asp:BoundField>
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
                <h4>Use registration page to add new app users</h4>

                <asp:SqlDataSource ID="SqlDataSourceDetails" runat="server" 
                    ConnectionString='<%$ ConnectionStrings:strComic %>' 
                    DeleteCommand="DELETE FROM [Userext] WHERE [Id] = @Id" 
                    InsertCommand="INSERT INTO [Userext] ([Id], [name], [lastName], [gender]) VALUES (@Id, @name, @lastName, @gender)" 
                    SelectCommand="SELECT * FROM [Userext]" UpdateCommand="UPDATE [Userext] SET [name] = @name, [lastName] = @lastName, [gender] = @gender WHERE [Id] = @Id">
                    <DeleteParameters>
                        <asp:Parameter Name="Id" Type="Object"></asp:Parameter>
                    </DeleteParameters>
                    <InsertParameters>
                        <asp:Parameter Name="Id" Type="Object"></asp:Parameter>
                        <asp:Parameter Name="name" Type="String"></asp:Parameter>
                        <asp:Parameter Name="lastName" Type="String"></asp:Parameter>
                        <asp:Parameter Name="gender" Type="String"></asp:Parameter>
                    </InsertParameters>
                    <UpdateParameters>
                        <asp:Parameter Name="name" Type="String"></asp:Parameter>
                        <asp:Parameter Name="lastName" Type="String"></asp:Parameter>
                        <asp:Parameter Name="gender" Type="String"></asp:Parameter>
                        <asp:Parameter Name="Id" Type="Object"></asp:Parameter>
                    </UpdateParameters>
                </asp:SqlDataSource>

                <asp:DetailsView ID="DetailsViewUser" runat="server"
                    Height="300px" Width="200px" AutoGenerateRows="False" DataKeyNames="Id" DataSourceID="SqlDataSourceDetails" BackColor="LightGoldenrodYellow" BorderColor="Tan" BorderWidth="1px" CellPadding="2" ForeColor="Black" GridLines="None">
                    <AlternatingRowStyle BackColor="PaleGoldenrod"></AlternatingRowStyle>

                    <EditRowStyle BackColor="DarkSlateBlue" ForeColor="GhostWhite"></EditRowStyle>
                    <Fields>
                        <asp:BoundField DataField="Id" HeaderText="Id" ReadOnly="True" SortExpression="Id"></asp:BoundField>
                        <asp:BoundField DataField="name" HeaderText="name" SortExpression="name"></asp:BoundField>
                        <asp:BoundField DataField="lastName" HeaderText="lastName" SortExpression="lastName"></asp:BoundField>
                        <asp:BoundField DataField="gender" HeaderText="gender" SortExpression="gender"></asp:BoundField>
                        <asp:CommandField ShowEditButton="True" ShowDeleteButton="True"></asp:CommandField>
                    </Fields>
                    <FooterStyle BackColor="Tan"></FooterStyle>

                    <HeaderStyle BackColor="Tan" Font-Bold="True"></HeaderStyle>

                    <PagerStyle HorizontalAlign="Center" BackColor="PaleGoldenrod" ForeColor="DarkSlateBlue"></PagerStyle>
                </asp:DetailsView>

            </div>
        </div>
    </div>

</asp:Content>
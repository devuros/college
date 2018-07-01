<%@ Page Title="Login page" Language="C#" MasterPageFile="~/masters/AuthTemp.Master" AutoEventWireup="true" CodeBehind="Login.aspx.cs" Inherits="Comics.Login" %>
<asp:Content ID="Content1" ContentPlaceHolderID="cphHead" runat="server">
    <%-- Head --%>

</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="cphMain" runat="server">
    <%-- Main --%>

    <div id="main-login">
        <div id="login-wrap">
        <h1 id="logo" style="font-style: normal; color: orange; font-size: 2.5em; padding-bottom: 20px;"><i class="fa  fa-laptop"></i> New Site</h1>
        <asp:Login ID="Login1" runat="server" MembershipProvider="MojProvajder" >
            <LayoutTemplate>
                <table cellspacing="0" cellpadding="1" style="border-collapse: collapse;">
                    <tr>
                        <td>
                            <table cellpadding="0">
                                <tr>
                                    <td align="center" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <asp:Label runat="server" AssociatedControlID="UserName" ID="UserNameLabel"></asp:Label></td>
                                    <td>
                                        <asp:TextBox runat="server" ID="UserName" placeholder="Username" CssClass="tbInput"></asp:TextBox>
                                        <asp:RequiredFieldValidator runat="server" ControlToValidate="UserName" 
                                            ErrorMessage="User Name is required." ValidationGroup="Login1" 
                                            ToolTip="User Name is required." ID="UserNameRequired">*</asp:RequiredFieldValidator>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <asp:Label runat="server" AssociatedControlID="Password" ID="PasswordLabel"></asp:Label></td>
                                    <td>
                                        <asp:TextBox runat="server" TextMode="Password" ID="Password" placeholder="Password" CssClass="tbInput"></asp:TextBox>
                                        <asp:RequiredFieldValidator runat="server" ControlToValidate="Password" 
                                            ErrorMessage="Password is required." ValidationGroup="Login1" 
                                            ToolTip="Password is required." ID="PasswordRequired">*</asp:RequiredFieldValidator>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <asp:CheckBox runat="server" Text="Remember me next time." ID="RememberMe" Visible="false"></asp:CheckBox>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2" style="color: Red;">
                                        <asp:Literal runat="server" ID="FailureText" EnableViewState="False"></asp:Literal>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="2">
                                        <asp:Button runat="server" CommandName="Login" Text="Log In" ValidationGroup="Login1" ID="LoginButton" CssClass="btnLogin"></asp:Button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </LayoutTemplate>
        </asp:Login>
        <div id="login-new">
			<a href="Register.aspx">Create a New Site account!</a>
		</div>
        </div>
    </div>

</asp:Content>
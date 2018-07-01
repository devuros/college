<%@ Page Title="Profile page" Language="C#" MasterPageFile="~/masters/AuthTemp.Master" AutoEventWireup="true" CodeBehind="Profile.aspx.cs" Inherits="Comics.Profile" %>
<asp:Content ID="Content1" ContentPlaceHolderID="cphHead" runat="server">
    <%-- Head --%>

</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="cphMain" runat="server">
    <%-- Main --%>
    <div id="main-register">
		<div id="register-wrapper">
            <div id="form-register-wrapper">
                <div id="form-register">
                    <h1 id="logo"> <a href="Default.aspx"><i class="fa fa-laptop"></i> NwS</a> </h1>
                    <h2>Edit profile</h2>

                    <table>
                        <tr>
                            <td align="center" colspan="2"></td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Label ID="LabelFirstName" runat="server" >First name</asp:Label>
                            </td>
                            <td>
                                <asp:Label ID="LabelLastName" runat="server">Last name</asp:Label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <asp:TextBox ID="TextBoxFirstName" runat="server" ReadOnly="true" 
                                    CssClass="input-small" BackColor="#e8e8e8"></asp:TextBox>
                            </td>
                            <td>
                                <asp:TextBox ID="TextBoxLastName" runat="server" ReadOnly="true" 
                                    CssClass="input-small" BackColor="#e8e8e8"></asp:TextBox>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Label ID="LabelGender" runat="server">Gender</asp:Label>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <asp:TextBox ID="TextBoxGender" runat="server" ReadOnly="true" 
                                    CssClass="input-large" BackColor="#e8e8e8"></asp:TextBox>
                            </td>
                        </tr>
                    </table>
                    <asp:ChangePassword ID="ChangePasswordProfile" runat="server">
                        <ChangePasswordTemplate>
                            <table cellspacing="0" cellpadding="1" style="border-collapse: collapse;">
                                <tr>
                                    <td>
                                        <table cellpadding="0">
                                            <tr>
                                                <td>
                                                    <asp:Label runat="server" AssociatedControlID="CurrentPassword" 
                                                        ID="CurrentPasswordLabel">Password:</asp:Label>
                                                    <asp:RequiredFieldValidator runat="server" ControlToValidate="CurrentPassword" 
                                                        ErrorMessage="Password is required." ValidationGroup="ChangePasswordProfile" 
                                                        ToolTip="Password is required." ID="CurrentPasswordRequired">*</asp:RequiredFieldValidator>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <asp:TextBox runat="server" TextMode="Password" ID="CurrentPassword" CssClass="input-small"></asp:TextBox>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <asp:Label runat="server" AssociatedControlID="NewPassword" 
                                                        ID="NewPasswordLabel">New Password:</asp:Label>
                                                    <asp:RequiredFieldValidator runat="server" ControlToValidate="NewPassword" 
                                                        ErrorMessage="New Password is required." ValidationGroup="ChangePasswordProfile" 
                                                        ToolTip="New Password is required." ID="NewPasswordRequired">*</asp:RequiredFieldValidator>
                                                </td>
                                                <td>
                                                    <asp:Label runat="server" AssociatedControlID="ConfirmNewPassword" 
                                                        ID="ConfirmNewPasswordLabel">Confirm New Password:</asp:Label>
                                                    <asp:RequiredFieldValidator runat="server" ControlToValidate="ConfirmNewPassword" 
                                                        ErrorMessage="Confirm New Password is required." ValidationGroup="ChangePasswordProfile" 
                                                        ToolTip="Confirm New Password is required." ID="ConfirmNewPasswordRequired">*</asp:RequiredFieldValidator>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <asp:TextBox runat="server" TextMode="Password" ID="NewPassword" CssClass="input-small"></asp:TextBox>
                                                </td>
                                                <td>
                                                    <asp:TextBox runat="server" TextMode="Password" ID="ConfirmNewPassword" CssClass="input-small"></asp:TextBox>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <asp:CompareValidator runat="server" ControlToCompare="NewPassword" ControlToValidate="ConfirmNewPassword" 
                                                        ErrorMessage="The Confirm New Password must match the New Password entry." 
                                                        Display="Dynamic" ValidationGroup="ChangePasswordProfile" ID="NewPasswordCompare"></asp:CompareValidator>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="color: Red;">
                                                    <asp:Literal runat="server" ID="FailureText" EnableViewState="False"></asp:Literal>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <asp:Button runat="server" CommandName="ChangePassword" Text="Change Password" 
                                                        ValidationGroup="ChangePasswordProfile" ID="ChangePasswordPushButton" 
                                                        CssClass="da"></asp:Button>
                                                    <asp:Button runat="server" CausesValidation="False" CommandName="Cancel" 
                                                        Text="Cancel" ID="CancelPushButton" CssClass="ne"></asp:Button>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </ChangePasswordTemplate>
                    </asp:ChangePassword>

                </div>
            </div>
        </div>
    </div>

</asp:Content>
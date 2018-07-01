<%@ Page Title="Contact page" Language="C#" MasterPageFile="~/masters/GeneralTemp.Master" AutoEventWireup="true" CodeBehind="Contact.aspx.cs" Inherits="Comics.Contact" %>
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
    <div id="main-contact-wrapper">
		<div id="main-contact">
			<div id="contact-form">
				<h2>Contact us</h2>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <div id="div_success" class="green" runat="server"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="Label1" runat="server" CssClass="label-padding">Name:</asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidatorName" runat="server" 
                                ErrorMessage="RequiredFieldValidator" ControlToValidate="tbName">*</asp:RequiredFieldValidator>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:TextBox ID="tbName" runat="server" CssClass="input-small"></asp:TextBox>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="Label2" runat="server" CssClass="label-padding">Email:</asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidatorEmail" runat="server" 
                                ErrorMessage="RequiredFieldValidator" ControlToValidate="tbEmail">*</asp:RequiredFieldValidator>
                            <asp:RegularExpressionValidator ID="RegularExpressionValidatorEmailFormat" runat="server" 
                                ErrorMessage="Invalid format" ControlToValidate="tbEmail" ValidationExpression="\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*"></asp:RegularExpressionValidator>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:TextBox ID="tbEmail" runat="server" CssClass="input-small"></asp:TextBox>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Label ID="Label3" runat="server" CssClass="label-padding">Message:</asp:Label>
                            <asp:RequiredFieldValidator ID="RequiredFieldValidatorMessage" runat="server" 
                                ErrorMessage="RequiredFieldValidator" ControlToValidate="tbMessage">*</asp:RequiredFieldValidator>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:TextBox ID="tbMessage" runat="server" TextMode="MultiLine" CssClass="taMessage"></asp:TextBox>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <asp:Button ID="btnSend" runat="server" Text="Send" CssClass="btnSend" OnClick="btnSend_Click" />
                        </td>
                    </tr>
                </table>
			</div>
			<div id="contact-information">
				<div class="row-information space">
					<div class="row-information-large">
						<h3>Information</h3>
					</div>
				</div>
				<div class="row-information space">
					<div class="row-information-small color">Address</div>
					<div class="row-information-small">Ringvagen 3<br/> 37500 Falun<br/> Sweden</div>
				</div>
				<div class="row-information space">
					<div class="row-information-small color">Telephone</div>
					<div class="row-information-large">+47 501 643</div>
				</div>
				<div class="row-information space">
					<div class="row-information-small color">Email</div>
					<div class="row-information-large">support@ns.com</div>
				</div>
				<div class="row-information space">
					<div class="row-information-small color">Work hours</div>
					<div class="row-information-large">mon-fri: 8-16h<br/> sat: 8-12h</div>
				</div>
			</div>
		</div>
	</div>

</asp:Content>

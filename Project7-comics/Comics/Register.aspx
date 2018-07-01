<%@ Page Title="Register page" Language="C#" MasterPageFile="~/masters/AuthTemp.Master" AutoEventWireup="true" CodeBehind="Register.aspx.cs" Inherits="Comics.Register" %>
<asp:Content ID="Content1" ContentPlaceHolderID="cphHead" runat="server">

</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="cphMain" runat="server">

    <div id="main-register">
		<div id="register-wrapper">
            <div id="form-register-wrapper">
                <div id="form-register">
                    <h1 id="logo"> <a href="Default.aspx"><i class="fa fa-laptop"></i> NwS</a> </h1>
                    <h2>Create an account</h2>

                    <asp:CreateUserWizard ID="CreateUserWizardRegister" runat="server" OnCreatedUser="CreateUserWizardRegister_CreatedUser">
                        <WizardSteps>
                            <asp:CreateUserWizardStep ID="CreateUserWizardStep1" runat="server">
                                <ContentTemplate>
                                    <table>
                                        <tr>
                                            <td align="center" colspan="1"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <asp:Label runat="server" AssociatedControlID="" ID="FirstNameLabel">First name</asp:Label>
                                                <asp:RequiredFieldValidator ID="RequiredFieldValidatorFirstName" runat="server" 
                                                    ControlToValidate="tbFirstName" ErrorMessage="First name is required."
                                                    ValidationGroup="CreateUserWizardRegister">*</asp:RequiredFieldValidator>
                                            </td>
                                            <td>
                                                <asp:Label runat="server" AssociatedControlID="" ID="LastNameLabel">Last name</asp:Label>
                                                <asp:RequiredFieldValidator ID="RequiredFieldValidatorLastName" runat="server" 
                                                    ControlToValidate="tbLastName" ErrorMessage="First name is required."
                                                    ValidationGroup="CreateUserWizardRegister">*</asp:RequiredFieldValidator>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <asp:TextBox runat="server" ID="tbFirstName" CssClass="input-small"></asp:TextBox>
                                            </td>
                                            <td>
                                                <asp:TextBox runat="server" ID="tbLastName" CssClass="input-small"></asp:TextBox>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                <asp:Label runat="server" AssociatedControlID="Email" ID="EmailLabel">E-mail</asp:Label>
                                                <asp:RequiredFieldValidator runat="server" ControlToValidate="Email" 
                                                    ErrorMessage="E-mail is required." ValidationGroup="CreateUserWizardRegister" 
                                                    ToolTip="E-mail is required." ID="EmailRequired">*</asp:RequiredFieldValidator>
                                            </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                <asp:TextBox runat="server" ID="Email" CssClass="input-small" placeholder="Someone@example.com"></asp:TextBox>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <asp:Label runat="server" AssociatedControlID="UserName" ID="UserNameLabel">Username</asp:Label>
                                                <asp:RequiredFieldValidator runat="server" ControlToValidate="UserName" 
                                                    ErrorMessage="User Name is required." ValidationGroup="CreateUserWizardRegister" 
                                                    ToolTip="User Name is required." ID="UserNameRequired">*</asp:RequiredFieldValidator>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <asp:TextBox runat="server" ID="UserName" CssClass="input-small"></asp:TextBox>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <asp:Label runat="server" AssociatedControlID="Password" ID="PasswordLabel">Password</asp:Label>
                                                <asp:RequiredFieldValidator runat="server" ControlToValidate="Password" 
                                                    ErrorMessage="Password is required." ValidationGroup="CreateUserWizardRegister" 
                                                    ToolTip="Password is required." ID="PasswordRequired">*</asp:RequiredFieldValidator>
                                            </td>
                                            <td>
                                                <asp:Label runat="server" AssociatedControlID="ConfirmPassword" ID="ConfirmPasswordLabel">Confirm password</asp:Label>
                                                <asp:RequiredFieldValidator runat="server" ControlToValidate="ConfirmPassword" 
                                                    ErrorMessage="Confirm Password is required." ValidationGroup="CreateUserWizardRegister" 
                                                    ToolTip="Confirm Password is required." ID="ConfirmPasswordRequired">*</asp:RequiredFieldValidator>
                                            </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <asp:TextBox runat="server" TextMode="Password" ID="Password" CssClass="input-small"></asp:TextBox>
                                            </td>
                                            <td>
                                                <asp:TextBox runat="server" TextMode="Password" ID="ConfirmPassword" CssClass="input-small"></asp:TextBox>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <asp:Label runat="server" AssociatedControlID="Question" ID="QuestionLabel">Security question</asp:Label>
                                                <asp:RequiredFieldValidator runat="server" ControlToValidate="Question" 
                                                    ErrorMessage="Security question is required." ValidationGroup="CreateUserWizardRegister" 
                                                    ToolTip="Security question is required." ID="QuestionRequired">*</asp:RequiredFieldValidator>
                                            </td>
                                            <td>
                                                <asp:Label runat="server" AssociatedControlID="Answer" ID="AnswerLabel">Security answer</asp:Label>
                                                <asp:RequiredFieldValidator runat="server" ControlToValidate="Answer" 
                                                    ErrorMessage="Security answer is required." ValidationGroup="CreateUserWizardRegister" 
                                                    ToolTip="Security answer is required." ID="AnswerRequired">*</asp:RequiredFieldValidator>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <asp:TextBox runat="server" ID="Question" CssClass="input-small"></asp:TextBox>
                                            </td>
                                            <td>
                                                <asp:TextBox runat="server" ID="Answer" CssClass="input-small"></asp:TextBox>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="1">
                                                <asp:CompareValidator runat="server" ControlToCompare="Password" ControlToValidate="ConfirmPassword" 
                                                    ErrorMessage="The Password and Confirmation Password must match." Display="Dynamic" 
                                                    ValidationGroup="CreateUserWizardRegister" ID="PasswordCompare"></asp:CompareValidator>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                <asp:Label runat="server" AssociatedControlID="" ID="GenderLabel">Gender</asp:Label>
                                                <asp:RequiredFieldValidator ID="RequiredFieldValidatorGender" runat="server" 
                                                    ErrorMessage="Gender is required." ControlToValidate="DropDownListGender" 
                                                    ValidationGroup="CreateUserWizardRegister" InitialValue="0">*</asp:RequiredFieldValidator>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                <asp:DropDownList ID="DropDownListGender" runat="server" CssClass="select-3">
                                                    <asp:ListItem Value="0">Select...</asp:ListItem>
                                                    <asp:ListItem Value="male">Male</asp:ListItem>
                                                    <asp:ListItem Value="female">Female</asp:ListItem>
                                                    <asp:ListItem Value="non">Not specified</asp:ListItem>
                                                </asp:DropDownList>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="1" style="color: Red;">
                                                <asp:Literal runat="server" ID="ErrorMessage" EnableViewState="False"></asp:Literal>
                                            </td>
                                        </tr>
                                    </table>
                                </ContentTemplate>
                            </asp:CreateUserWizardStep>
                            <asp:CompleteWizardStep ID="CompleteWizardStep1" runat="server">
                            </asp:CompleteWizardStep>
                        </WizardSteps>
                    </asp:CreateUserWizard>

                </div>
            </div>
        </div>
    </div>

</asp:Content>
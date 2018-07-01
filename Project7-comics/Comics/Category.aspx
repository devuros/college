<%@ Page Title="Category page" Language="C#" MasterPageFile="~/masters/GeneralTemp.Master" AutoEventWireup="true" CodeBehind="Category.aspx.cs" Inherits="Comics.Category" %>
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
    <div id="main-artikli-wrapper">
		<div id="main-artikli">
			<div id="artikli-lista">
				<h2 runat="server" id="h2_tag"></h2>
                <div class="prikaz-row">
                    <asp:PlaceHolder ID="PlaceHolderProducts" runat="server"></asp:PlaceHolder>
                </div>
			</div>
			<div id="artikli-desc">
				<h3>Details</h3>
				<div id="desc-prikaz">
					Click on a product to see more details
				</div>
			</div>
		</div>
	</div>

</asp:Content>
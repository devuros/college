<%@ Page Title="Your cart" Language="C#" MasterPageFile="~/masters/GeneralTemp.Master" AutoEventWireup="true" CodeBehind="Cart.aspx.cs" Inherits="Comics.Cart" %>
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
    <div id="main-cart-wrapper">
		<div id="main-cart">
			<div id="cart-left">
				<div id="left-product-wrapper">
					<h2>Your shopping cart</h2>
					<%-- Message + Items --%>
                    <asp:PlaceHolder ID="PlaceHolderMessage" runat="server"></asp:PlaceHolder>
                    <asp:PlaceHolder ID="PlaceHolderItems" runat="server"></asp:PlaceHolder>
				</div>
				<div id="left-subtotal">
					<div id="subtotal-left"><p>Subtotal: </p></div>
					<div id="subtotal-right">
                        <%-- Subtotal... --%>
						<p><asp:PlaceHolder ID="PlaceHolderSubtotal" runat="server"></asp:PlaceHolder></p>
					</div>
					<hr/>
                    <asp:Button ID="ButtonPurchase" runat="server" Text="Purchase" 
                        CssClass="btnBuy" Enabled="false" Visible="false" OnClick="ButtonPurchase_Click"/>
				</div>
				<div id="continue-shopping">
                    <asp:HyperLink ID="HyperLinkContinueShopping" runat="server" NavigateUrl="~/Default.aspx">Continue shopping</asp:HyperLink>
				</div>
			</div>
			<div id="cart-right"></div>
		</div>
	</div>

</asp:Content>
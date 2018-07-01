<%@ Page Title="Default page" Language="C#" MasterPageFile="~/masters/MainTemp.Master" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="Comics.Default" %>
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
<asp:Content ID="Content3" ContentPlaceHolderID="cphSlider" runat="server">
    <%-- Slider --%>
    <div id="image" title="Welcome"></div>

</asp:Content>
<asp:Content ID="Content4" ContentPlaceHolderID="cphMain" runat="server">
    <%-- Main --%>
    <asp:SqlDataSource ID="sqlDataSourceCategory" runat="server" 
        ConnectionString='<%$ ConnectionStrings:strComic %>' 
        SelectCommand="SELECT * FROM [Category]"></asp:SqlDataSource>
    <div id="welcome">
	    <h2>Welcome dear visitor!</h2>
	    <p>
            You have travelled great distance, come rest. Here you can find what every your thirsty soul may desire.
		    Don't hesitate see us, join us, register and then login to see more of our great services.
		    We honor our customers and guests as well don't be shy come, explore.<br/>
		    Choose from our divine categories!
	    </p>
    </div>
    <div class="row-wrapper">
	    <div class="row" id="div_Category" runat="server"></div>
    </div>

</asp:Content>

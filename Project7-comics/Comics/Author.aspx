<%@ Page Title="Author page" Language="C#" MasterPageFile="~/masters/GeneralTemp.Master" AutoEventWireup="true" CodeBehind="Author.aspx.cs" Inherits="Comics.Author" %>
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

    <div id="main-author">
	    <div id="author-desc">
		    <p>
			    Uroš Jovanović <b>(11/13)</b> was born in Belgrade on April 7, 1994. He grew up in Smederevo
			    where he finished elementary school, after that he enrolled in high school.
			    After graduating from high school in 2012/13 he enrolled in ICT College of Vocational studies.
			    <br/><br/>
			    Currenly he is inspired by the emense possibilities of <i>PHP: Hypertext Preprocessor</i>
			    and looking forward to learning Laravel in the future.
		    </p>
	    </div>
	    <div id="author-image">
		    <img src="assets/images/autor.png" alt="autor" title="Uroš B Jovanović" />
	    </div>
    </div>

</asp:Content>

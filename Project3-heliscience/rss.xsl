<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<head>
				<title>Rss feed</title>
				<link rel="shortcut icon" href="Images/Icon1.jpg"/>
			</head>
			<body style="background: #218c8d; font-family: Roboto, arial, sans-serif;">
				<table style="margin: 20px 0px 0px 100px;">
					<xsl:for-each select="rss/channel/item">
						<tr style="color: #ef7126;font-size: 1.8em;">
							<td>Title</td>
							<td>
								<b>-<xsl:value-of select="title" /> </b>
							</td>
						</tr>
						<tr style="color: #f0f0f0;">
							<td style="font-size: 1.2em; vertical-align: top;">Desc:</td>
							<td style="width: 450px;">
								<xsl:value-of select="description" />
							</td>
						</tr>
						<tr style="color: #f0f0f0;">
							<td style="font-size: 1.2em;">Loc:</td>
							<td>
								<xsl:value-of select="link" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<br/>
							</td>
						</tr>
					</xsl:for-each>
				</table>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
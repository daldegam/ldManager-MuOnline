/****** Object:  Table [dbo].[webLdManagerUsers]    Script Date: 08/20/2010 14:50:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[webLdManagerUsers](
	[id] [tinyint] IDENTITY(1,1) NOT NULL,
	[username] [varchar](10) NOT NULL,
	[password] [varchar](10) NOT NULL,
	[previlegy] [tinyint] NOT NULL CONSTRAINT [DF_webLdManagerUsers_previlegy]  DEFAULT ((0))
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO

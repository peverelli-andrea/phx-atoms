<?php

namespace Phx\Atom\Heading;

use Phx\Core\TypographyRole;

enum HeadingTypographyRole
{
	case DISPLAY;
	case HEADLINE;
	case TITLE;

	final public function getTypographyRole(): TypographyRole
	{
		return match($this) {
			self::DISPLAY => TypographyRole::DISPLAY,
			self::HEADLINE => TypographyRole::HEADLINE,
			self::TITLE => TypographyRole::TITLE,
		};
	}
}

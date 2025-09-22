<?php

namespace Phx\Atom\Heading;

use Phx\Core\TypographyRole;

enum HeadingTypographyRole
{
	case DISPLAY;
	case HEADING;
	case TITLE;

	final public function getTypographyRole(): TypographyRole
	{
		return match($this) {
			self::DISPLAY => TypographyRole::DISPLAY,
			self::HEADING => TypographyRole::HEADING,
			self::TITLE => TypographyRole::TITLE,
		};
	}
}

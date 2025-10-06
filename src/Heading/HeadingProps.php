<?php

namespace Phx\Atom\Heading;

use Phx\Core\CommonProps;
use Phx\Core\TypographySubRole;
use Phx\Core\Palette;
use Phx\Core\BackgroundColor;
use Phx\Core\ForegroundColor;

final class HeadingProps
{
	public CommonProps $common;

	final public function __construct(
		public string $content = "",
		public TypographySubRole $sub_role = TypographySubRole::LARGE,
		public Palette|BackgroundColor|ForegroundColor|string $color = Palette::SURFACE,
		public HeadingLevel $level = HeadingLevel::H1,
		public HeadingTypographyRole $role = HeadingTypographyRole::DISPLAY,
		?CommonProps $common = null,
	) {
		$this->common = $common ?? new CommonProps();
	}
}

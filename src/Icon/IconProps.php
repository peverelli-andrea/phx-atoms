<?php

namespace Phx\Atom\Icon;

use Phx\Core\CommonProps;
use Phx\Core\Palette;
use Phx\Core\BackgroundColor;
use Phx\Core\ForegroundColor;
use Phx\Core\TypographyWeight;

final class IconProps
{
	public CommonProps $common;

	final public function __construct(
		public IconVariant $variant,
		public IconSize $size = IconSize::PX24,
		public IconStyle $style = IconStyle::OUTLINED,
		public Palette|BackgroundColor|ForegroundColor|string $color = Palette::SURFACE,
		public TypographyWeight $weight = TypographyWeight::REGULAR,
		public bool $with_copy = false,
		?CommonProps $common = null,
	) {
		$this->common = $common ?? new CommonProps();
	}
}

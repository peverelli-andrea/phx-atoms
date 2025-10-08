<?php

namespace Phx\Atom\Paragraph;

use Phx\Core\TypographyRole;
use Phx\Core\TypographySubRole;
use Phx\Core\Palette;
use Phx\Core\ForegroundColor;
use Phx\Core\BackgroundColor;
use Phx\Core\CommonProps;

final class ParagraphProps
{
	public CommonProps $common;

	final public function __construct(
		public string $content = "",
		public TypographyRole $role = TypographyRole::BODY,
		public TypographySubRole $sub_role = TypographySubRole::LARGE,
		public Palette|BackgroundColor|ForegroundColor|string $color = Palette::SURFACE,
		?CommonProps $common = null,
	) {
		$this->common = $common ?? new CommonProps();
	}
}

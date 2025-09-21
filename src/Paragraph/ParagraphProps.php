<?php

namespace Phx\Atom\Paragraph;

use Phx\Core\TypographySubRole;
use Phx\Core\Palette;
use Phx\Core\CommonProps;

final class ParagraphProps
{
	public CommonProps $common;

	final public function __construct(
		public string $content = "",
		public TypographySubRole $sub_role = TypographySubRole::LARGE,
		public Palette $color = Palette::SURFACE,
		?CommonProps $common = null,
	) {
		$this->common = $common ?? new CommonProps();
	}
}

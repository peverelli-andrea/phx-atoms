<?php

namespace Phx\Atom\Paragraph;

use Phx\Core\TypographySubRole;
use Phx\Core\CommonProps;

final class ParagraphProps
{
	public CommonProps $common;

	final public function __construct(
		public string $content = "",
		public TypographySubRole $sub_role = TypographySubRole::LARGE,
		?CommonProps $common = null,
	) {
		$this->common = $common ?? new CommonProps();
	}
}

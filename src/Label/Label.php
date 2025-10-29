<?php

namespace Phx\Atom\Label;

use Phx\Core\Component;
use Phx\Core\Render;
use Phx\Core\CssColorProperty;
use Phx\Core\ColorType;

final class Label extends Component
{
	final public function __construct() {}

	final public function render(LabelProps $props): Render
	{
		$this->registerCommonProps(common_props: $props->common);

		$this->addColor(
			color: $props->color,
			css_color_property: CssColorProperty::COLOR,
			color_type: ColorType::FOREGROUND,
		);

		$this->addTypography(
			role: $props->role,
			sub_role: $props->sub_role,
		);

		$attributes = $this->makeAttributes();

		return $this->makeRender(
			html: <<<HTML
			<label$attributes>$props->content</label>
			HTML,
		);
	}
}

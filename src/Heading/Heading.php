<?php

namespace Phx\Atom\Heading;

use Phx\Core\Component;
use Phx\Core\Render;
use Phx\Core\ColorType;
use Phx\Core\CssColorProperty;

final class Heading extends Component
{
	final public function __construct() {}

	final public function render(HeadingProps $props): Render
	{
		$this->registerCommonProps(common_props: $props->common);

		$this->addColor(
			color: $props->color,
			color_type: ColorType::FOREGROUND,
			css_color_property: CssColorProperty::COLOR,
		);

		$this->addTypography(
			role: $props->role,
			sub_role: $props->sub_role,
		);

		$attributes = $this->makeAttributes();

		return $this->makeRender(
			html: <<<HTML
			<{$props->level->value}$attributes>{$props->content}</{$props->level->value}>
			HTML
		);
	}
}

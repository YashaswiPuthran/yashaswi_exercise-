<?php

namespace Drupal\field_type\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Define the "field type".
 *
 * @FieldWidget(
 *   id = "field_widget",
 *   label = @Translation(" Field Widget"),
 *   description = @Translation("Desc for Field Widget"),
 *   field_types = {
 *     "field_type"
 *   }
 * )
 */
class FieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = $items[$delta]->value ?? "";
    $element = $element + [
      '#type' => 'textfield',
      '#suffix' => "<span>" . $this->getFieldSetting("moreinfo") . "</span>",
      '#default_value' => $value,
      '#attributes' => [
        'placeholder' => $this->getSetting('placeholder'),
      ],
    ];
    return ['value' => $element];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'placeholder' => 'default',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['placeholder'] = [
      '#type' => 'textfield',
      '#title' => 'Placeholder text',
      '#default_value' => $this->getSetting('placeholder'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t("placeholder text: @placeholder", ["@placeholder" => $this->getSetting("placeholder")]);
    return $summary;
  }

}

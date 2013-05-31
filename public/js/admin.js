// Show/hide entity options
function entityShowChange(el, entity_name)
{
    if (jQuery(el).is(':checked')) {
        jQuery("#entity_container_"+entity_name).show();
    } else {
        jQuery("#entity_container_"+entity_name).hide();
    }
}

// Show/hide options on Use settings from select
function userSettingsFromChange(el, entity_name)
{
    if (jQuery(el).val()) {
        jQuery("#use_settings_from_container_"+entity_name).hide();
    } else {
        jQuery("#use_settings_from_container_"+entity_name).show();
    }
}

// Toggle collapable area
function toggleCollapsable(el)
{
    jQuery(el).parent().children('.inside').toggle();
}

// Toggle upgrade website instructions
function toggleToUpgrade()
{
    jQuery("#likebtn_like_button_to_upgrade").toggle();
}

// Toggle Post format container
function postFormatAllChange(el, entity_name)
{
    if (jQuery(el).is(':checked')) {
        jQuery("#post_format_container_"+entity_name).hide();
    } else {
        jQuery("#post_format_container_"+entity_name).show();
    }
}
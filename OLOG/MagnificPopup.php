<?php
namespace OLOG;

class MagnificPopup
{
    static public function button(
        $create_form_element_id,
        $button_classes,
        $button_contents_html = '+'
    ){
        $html = '';

        static $_magnific_popup_scripts_on_page = false;

        if (!$_magnific_popup_scripts_on_page) {
            $html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">';
            $_magnific_popup_scripts_on_page = true;
        }

        $html .= '<a href="#' . $create_form_element_id . '" class=" ' . $button_classes. ' open-' . $create_form_element_id . '">' . $button_contents_html . '</a>';

        $html .= '<script>
            $(document).ready(
                    function (){
                        $(".open-' . $create_form_element_id . '").magnificPopup({type: "inline", midClick: true});
                    }
            );
            </script>';

        return $html;
    }

    static public function popupHtml($create_form_element_id, $create_form_html){
        $html = '';

        $html .= '<div style="position: relative; background: #FFF; padding: 50px 20px 30px 20px; width: auto; max-width: 700px; margin: 20px auto;" id="' . $create_form_element_id . '" class="mfp-hide">';
        $html .= $create_form_html;
        $html .= '</div>';

        return $html;
    }
}
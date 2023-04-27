<?php


namespace Markdown;


use Superscript\Converter as SuperscriptConverter;

class Parser extends \ParsedownExtra
{
    protected $footnoteCount = 0;
    protected $pdfMode = true;

    /**
     * @param bool $pdfMode
     */
    public function setPdfMode($pdfMode = true)
    {
        $this->pdfMode = $pdfMode;
    }

    protected function element(array $Element)
    {
        if ($this->safeMode)
        {
            $Element = $this->sanitiseElement($Element);
        }

        $markup = '<'.$Element['name'];

        if (isset($Element['attributes']))
        {
            foreach ($Element['attributes'] as $name => $value)
            {
                if ($value === null)
                {
                    continue;
                }

                $markup .= ' '.$name.'="'.self::escape($value).'"';
            }
        }

        if (isset($Element['text']))
        {
            $markup .= '>';

            if (!isset($Element['nonNestables']))
            {
                $Element['nonNestables'] = array();
            }

            if (isset($Element['handler']))
            {

                $markup .= $this->{$Element['handler']}($Element['text'], $Element['nonNestables']);
            }
            else
            {
                if (
                    isset($Element['attributes']['id']) && preg_match('/^fn:/', $Element['attributes']['id'])
                    ||
                    isset($Element['attributes']['class']) && preg_match('/footnote-ref/', $Element['attributes']['class'])

                ) {
                    $markup .= $Element['text'];
                } else {
                    $markup .= self::escape($Element['text'], true);
                }
            }

            $markup .= '</'.$Element['name'].'>';
        }
        else
        {
            $markup .= ' />';
        }

        return $markup;
    }

    protected function buildFootnoteElement()
    {
        $Element = array(
            'name' => 'div',
            'attributes' => array('class' => 'footnotes'),
            'handler' => 'elements',
            'text' => array(
                array(
                    'name' => 'hr',
                ),
                array(
                    'name' => 'ol',
                    'handler' => 'elements',
                    'text' => array(),
                ),
            ),
        );

        uasort($this->DefinitionData['Footnote'], 'self::sortFootnotes');

        foreach ($this->DefinitionData['Footnote'] as $definitionId => $DefinitionData)
        {
            if ( ! isset($DefinitionData['number']))
            {
                continue;
            }

            $text = $DefinitionData['text'];

            $text = parent::text($text);

            $numbers = range(1, $DefinitionData['count']);

            $backLinksMarkup = '';

            foreach ($numbers as $number)
            {
                $backLinksMarkup .= ' <a href="#fnref'.$number.':'.$definitionId.'" rev="footnote" class="footnote-backref">&#8617;</a>';
            }

            $backLinksMarkup = substr($backLinksMarkup, 1);

            if (substr($text, - 4) === '</p>')
            {
                $backLinksMarkup = '&#160;'.$backLinksMarkup;

                $text = substr_replace($text, $backLinksMarkup, - 4);
            }
            else
            {
                $text .= "\n".$backLinksMarkup;
            }

            $Element['text'][1]['text'] []= array(
                'name' => 'li',
                'attributes' => array('id' => 'fn:'.$definitionId),
                'text' => "\n".$text."\n",
            );
        }

        return $Element;
    }

    protected function inlineFootnoteMarker($Excerpt)
    {
        if (preg_match('/^\[\^(.+?)\]/', $Excerpt['text'], $matches))
        {
            $name = $matches[1];

            if ( ! isset($this->DefinitionData['Footnote'][$name]))
            {
                return;
            }

            $this->DefinitionData['Footnote'][$name]['count'] ++;

            if ( ! isset($this->DefinitionData['Footnote'][$name]['number']))
            {
                $this->DefinitionData['Footnote'][$name]['number'] = ++ $this->footnoteCount; # » &
            }

            if($this->pdfMode) {
                $Element = array(
                    'name' => 'span',
                    'attributes' => array('id' => 'fnref'.$this->DefinitionData['Footnote'][$name]['count'].':'.$name),
                    'handler' => 'element',
                    'text' => array(
                        'name' => 'a',
                        'attributes' => array('href' => '#fn:'.$name, 'class' => 'footnote-ref'),
                        'text' => SuperscriptConverter::getHtmlEntities(html_entity_decode($this->DefinitionData['Footnote'][$name]['number'])),
                    ),
                );
            } else {
                $Element = array(
                    'name' => 'sup',
                    'attributes' => array('id' => 'fnref'.$this->DefinitionData['Footnote'][$name]['count'].':'.$name),
                    'handler' => 'element',
                    'text' => array(
                        'name' => 'a',
                        'attributes' => array('href' => '#fn:'.$name, 'class' => 'footnote-ref'),
                        'text' => $this->DefinitionData['Footnote'][$name]['number'],
                    ),
                );
            }


            return array(
                'extent' => strlen($matches[0]),
                'element' => $Element,
            );
        }
    }
}

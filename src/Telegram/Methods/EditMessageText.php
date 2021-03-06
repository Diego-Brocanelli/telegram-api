<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;

/**
 * Use this method to edit text messages sent by the bot or via the bot (for inline bots). On success, if edited message
 * is sent by the bot, the edited Message is returned, otherwise True is returned
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#editmessagetext
 */
class EditMessageText extends TelegramMethods
{
    /**
     * Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target
     * channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Required if inline_message_id is not specified. Unique identifier of the sent message
     * @var int
     */
    public $message_id = 0;

    /**
     * Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string
     */
    public $inline_message_id = '';

    /**
     * New text of the message
     * @var string
     */
    public $text = '';

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in your bot's message
     * @var string
     */
    public $parse_mode = '';

    /**
     * Optional. Disables link previews for links in this message
     * @var boolean
     */
    public $disable_web_page_preview = false;

    /**
     * Optional. A JSON-serialized object for an inline keyboard.
     * @var Markup
     */
    public $reply_markup = null;

    public function getMandatoryFields(): array
    {
        return [
            'text',
        ];
    }
}

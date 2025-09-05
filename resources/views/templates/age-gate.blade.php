<div class="cm-agegate cm-agegate--visible">
    <form class="cm-form cm-form--agegate" action="{{ $actionUrl }}" id="cm-form--agegate" method="post">
        <input type="hidden" name="action" value="{{ $actionName }}" />
        <input type="hidden" name="{{ $namePrefix . '[pageid]' }}" value="{{ $pageId }}" />
        <div class="cm-form__header">
            <img src="{{ $logo['url'] }}" width="200" height="197" aria-hidden="true" />
            <p class="cm-font--heading">{{ __('Welcome to Brauerei Gutmann', 'wecmagegate') }}</p>
        </div>
        <div class="cm-form__body">
            <div class="cm-form__message">
                <p class="cm-font--small">{{ __('This website requires you to be of legal drinking age in your country to enter. Please confirm that you are of legal drinking age to proceed.', 'wecmagegate') }}</p>
            </div>
            <div class="cm-form__input">
                <input type="radio" name="{{ $namePrefix . '[status]' }}" id="cm-agegate--confirm" value="confirm">
                <label for="cm-agegate--confirm">
                    {{ __('I am of legal drinking age', 'wecmagegate') }}
                </label>
            </div>
            <div class="cm-form__input">
                <input type="radio" name="{{ $namePrefix . '[status]' }}" id="cm-agegate--decline" value="decline">
                <label for="cm-agegate--decline">
                    {{ __('I am not of legal drinking age', 'wecmagegate') }}
                </label>
            </div>
        </div>
        <div class="cm-form__footer">
            <p class="cm-font--small">
                {{ __('If you confirm your age by clicking “Yes” a cookie will be set in your browser. This cookie is valid for 30 days. During this period, you will not need to confirm your age again. Your information will not be transferred to our system or passed on to third parties at any time.', 'wecmagegate') }}
            </p>
        </div>
    </form>
</div>
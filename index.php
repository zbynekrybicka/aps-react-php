<?php
use App\Meta\Slice;
use App\Relation\Application;

if ($_SERVER['argv'][1] === 'build') {
    define('API_URL', 'https://api.album.zbynekrybicka.cz');
    define('FRONT_URL', 'https://album.zbynekrybicka.cz');
} else {
    define('API_URL', 'http://localhost:3001');
    define('FRONT_URL', 'http://localhost:3000');
}

require __DIR__ . '/vendor/autoload.php';

/*
 * Interface
 */
$app = new Application();

$errorMessage = $app->condition('errorMessage', 'isErrorMessageShown', '*.errorMessage !== false');
$preloader = $app->subComponent('preloaderContainer')->condition('preloader', 'isPreloaderShown', '*.preloader');
$loginForm = $app->condition('loginForm', 'isNotLoggedIn', '*.authToken === false');
$admin = $app->condition('admin', 'isLoggedIn', '*.authToken !== false');
    $wall = $admin->condition('wall', 'isWall', '*.side === false');
        $wallControl = $wall->subComponent('wallControl');
            $wallNextButton = $wallControl->subComponent('wallNext');
            $wallCategory = $wallControl->subComponent('wallCategory');
            $plusButton = $wallControl->subComponent('plusButton');
        $wallImage = $wall->condition('wallImage', 'isLoadedImages', '*.wallImage.active');

    $plusImage = $admin->condition('plusImage', 'isPlusImage', '*.side === "plusImage"');
        $plusImageBackButton = $plusImage->subComponent('plusImageBackButton');
        // $plusImageUpload = $plusImage->subcomponent('plusImageUpload');
        $plusImageUrl = $plusImage->subComponent('plusImageUrl');

    $googleImage = $admin->condition('googleImage', 'isGoogleImage', '*.side === "googleImage"');
        $googleImageSearch = $googleImage->subComponent('googleImageSearch');
        $googleImageDetail = $googleImage->condition('googleImageDetail', 'googleImageDetail', '*.googleImagesData.detail');
            $googleImageListDetail = $googleImageDetail->subComponent('googleImageListDetail');
            $googleImageCloseDetail = $googleImageDetail->subComponent('googleImageCloseDetail');
        $googleImageResults = $googleImage->subComponent('googleImageResults');
        $googleImageSelected = $googleImage->subComponent('googleImageSelected');
        $googleImageAdd = $googleImage->subComponent('googleImageAdd');


/*
 * Constants
 */
$app->constant('errorMessagge', '')

    ->constant('errMessages.UserNotFound', 'Uživatel nenalezen')
    ->constant('errMessages.BadPassword', 'Chybné heslo')

    ->constant('errMessages.ImageNotFound', 'Obrázek nebyl nalezen nebo je chráněný proti kopírování. Zkuste jej stáhnout a provést upload.')
    ->constant('errMessages.DuplicateImage', 'Obrázek již máte uložený.')

    ->constant('errMessages.pageNotLoaded', 'Stránku se nepodařilo načíst');


/*
 * ErrorMessage
 */
$errorMessage->elementWithState('div', 'errorMessage', '*.errMessages[*.errorMessage]')
    ->paramClass('errorMessage')
    ->paramEventReducer('click', 'hideErrorMessage', ['*.errorMessage = false'])
    ->insertElement();

/*
 * LoginForm
 */
$loginForm
    ->inputElement('text', 'Uživatelské jméno', 'loginFormUsername', '*.loginForm.username')
    ->inputElement('password', 'Heslo', 'loginFormPassword', '*.loginForm.password')
    ->elementWithLabel('button', 'Přihlásit se')
        ->paramValue('className', 'loginFormSubmit')
        ->paramEventAjax('click', 'postLogin', 'loginForm', '*.loginForm')
            ->request(Slice::METHOD_POST, '/login', '{}', 'user', 'login')
            ->setBeforeAfterAsPreloader()
            ->success([
                '*.authToken = action.payload',
                '*.uploadImageData.authToken = action.payload',
                '*.wallImage.getImageData.authToken = action.payload',
                '*.googleImagesData.authToken = action.payload'
            ])
            ->errorMessage()
//            ->test('postLoginSuccess', 'post', '/login', ['username' => 'zbynek.rybicka', 'password' => 'mojeMilaJulinka'], 200)
//            ->test('postLoginFail', 'post', '/login', ['username' => 'zbynek.rybicka', 'password' => 'mojeMila'], 400)
            ->insertAjax()
        ->insertElement();


/*
 * Admin
 */
$admin->initAjax('getImages', 'getImagesData', '*.wallImage.getImageData')
    ->request(Slice::METHOD_GET, '/images', '{ headers: { Authorization: param.authToken }}', 'algorithm', 'getImages')
    ->setBeforeAfterAsPreloader()
    ->success([
        '*.wallImage.que = action.payload.images',
        '*.wallImage.categories = action.payload.categories',
        '*.wallImage.countdown = 5',
        'let image = *.wallImage.que.pop()',
        '*.wallImage.activeId = image.id',
        '*.wallImage.shownAt = moment().format("X")',
        '*.wallImage.active = "' . API_URL . '/files/images/" + image.filename'
    ])
    ->errorMessage()
    ->insertAjax();


/*
 * WallImage
 */
$wallImage
    ->element('img')
    ->paramState('src', 'actual', '*.wallImage.active')
    ->insertElement();


/*
 * PlusButton
 */
$plusButton
    ->elementWithLabel('button', '+')
    ->paramEventReducer('click', 'switchToUpload', ['*.side = "googleImage"' ])
    ->insertElement();



/*
 * PlusImageUrl
 */
$plusImageUrl->element('input')
        ->paramClass('url')
        ->paramValue('type', 'text')
        ->paramEventReducer('change', 'checkImage', ['*.uploadImageData.url = action.payload'])
        ->insertElement()
    ->element('input')
        ->paramClass('category')
        ->paramValue('type', 'text')
        ->paramEventReducer('change', 'setCategory', ['*.uploadImageData.category = action.payload'])
        ->insertElement()
    ->elementWithLabel('button', 'Nahrát vybraný obrázek')
        ->paramClass('uploadImage')
        ->paramEventAjax('click', 'postImage', 'imageUrl', '*.uploadImageData')
            ->authRequest('post', '/images', 'param.authToken', 'imageUpload', 'copyFromUrl')
            ->setBeforeAfterAsPreloader()
            ->success([ 'state.side = false' ])
            ->errorMessage()
            ->insertAjax()
        ->insertelement()
    ->element('img')
        ->paramState('src', 'image', '*.uploadImageData.url')
        ->insertElement();



/*
 * WallCategory
 */
$wallCategory->elementWithState('div', 'category', '*.wallImage.getImageData.category')
    ->paramEventReducer('click', 'selectCategoryDialog', ['*.dialogs.selectCategory = true'])
    ->insertElement();

/*
 * WallNextButton
 */
$wallNextButton->elementWithLabel('button', '&gt;')
        ->paramEventAjax('click', 'swipe', 'imageData', '*.wallImage')
            ->authRequest('put', '/image-score', 'param.getImageData.authToken', 'algorithm', 'addScore')
            ->invisibleBeforeAndAfter()
            ->before([])
            ->success([
                'if (!*.wallImage.que.length) *.wallImage.que = action.payload',
                'let image = *.wallImage.que.pop()',
                '*.wallImage.activeId = image.id',
                '*.wallImage.shownAt = moment().format("X")',
                '*.wallImage.active = "' . API_URL . '/files/images/" + image.filename',
            ])
            ->noError()
            ->insertAjax()
        ->insertElement();

/*
 * PlusImageBackButton
 */
$plusImageBackButton->elementWithLabel('button', '&lt;')
    ->paramEventReducer('click', 'backToWall', ['*.side = false'])
    ->insertElement();


/*
 * GoogleImageSearch
 */
$googleImageSearch->element('input')
        ->paramValue('type', 'text')
        ->paramEventReducer('change', 'setGoogleExpression', ['*.googleImagesData.search = action.payload'])
        ->insertElement()
    ->elementWithLabel('button', 'Vyhledat na Googlu')
        ->paramEventAjax('click', 'getGoogleImages', 'googleImagesData', '*.googleImagesData')
            ->request('get', '/google-search', '{ params: { search: param.search } }', 'googleImageSearch', 'search')
            ->setBeforeAfterAsPreloader()
            ->success(['*.googleImagesData.results = action.payload'])
            ->errorMessage()
            ->insertAjax()
        ->insertElement();
$app->constant('googleImagesData.search', '')
    ->constant('googleImagesData.results', [])
    ->constant('googleImagesData.selected', [])
    ->constant('googleImagesData.detail', false);

/*
 * GoogleImageResults
 */
$googleImageResults->cycleComponent('googleImageResult', 'googleImageResults', '*.googleImagesData.results')
    ->element('img')
        ->paramProps('src', 'item.image')
        ->paramEventAjax('click', 'getGoogleImagesFull', 'props.item')
            ->request('get', '/google-result-images', '{ params: { url: param.link } }', 'googleImageSearch', 'getImageByGoogleUrl')
            ->setBeforeAfterAsPreloader()
            ->success(['state.googleImagesData.detail = action.payload'])
            ->errorMessage()
            ->insertAjax()
        ->insertElement();

/*
 * GoogleImageDetail
 */
$googleImageListDetail->subComponent('googleImageDetailList')
    ->cycleComponent('googleImageDetailItem', 'googleImageDetail', '*.googleImagesData.detail')
    ->element('img')
        ->paramProps('src', 'item')
        ->paramEventReducer('click', 'selectDetailedImage', [
            '*.googleImagesData.selected.push(action.payload)',
            '*.googleImagesData.detail.splice(*.googleImagesData.detail.indexOf(action.payload), 1)'
        ], 'props.item')
        ->insertElement();

$googleImageCloseDetail->elementWithLabel('button', 'Zavřít náhledy')
    ->paramEventReducer('click', 'closeGoogleImageDetail', [ '*.googleImagesData.detail = false' ])
    ->insertElement();

/*
 * GoogleImageSelected
 */
$googleImageSelected->cycleComponent('googleImageSelectedItem', 'selectedImages', '*.googleImagesData.selected')
    ->element('img')
        ->paramProps('src', 'item')
        ->insertElement();

/*
 * GoogleImageAdd
 */
$googleImageAdd->elementWithLabel('button', 'Přidat vybrané obrázky')
        ->paramEventAjax('click', 'postGoogleImages', 'selectedImagesData', '*.googleImagesData')
            ->authRequest('post', '/google-images', 'param.authToken', 'googleImageSearch', 'insertSelectedImages')
            ->setBeforeAfterAsPreloader()
            ->success(['state.side = false'])
            ->errorMessage()
            ->insertAjax()
        ->insertElement();

/*
 *
 *
 *
 *
 *
 *
 * Testing
 */
$app->test('Login')
    ->check('.LoginForm input', 2)
    ->check('.LoginForm .loginFormSubmit')
    ->type('.LoginForm [name=loginFormUsername]', 'zbynek.rybicka')
    ->type('.LoginForm [name=loginFormPassword]', 'mojeMilaJulinka')
    ->click('.LoginForm .loginFormSubmit')
    ->checkNot('.LoginForm')
    ->check('.Admin')
    ->screenshot('afterLogin');

$app->test('Wall', 'Login')
    ->check('.WallImage img')
    ->click('.WallNext button')
    ->screenshot('wallImage');

$app->test('NewImage', 'Login')
    ->click('.PlusButton button')
    ->check('.PlusImageUpload')
    ->type('.PlusImageUrl input.category', 'podprsenky')
    ->type('.PlusImageUrl input.url', 'https://www.triola.cz/8048-product_detail/Podprsenka-TRIOLA-28795.jpg')
    ->click('.PlusImageUrl button.uploadImage');

$app->test('Google images', 'Login')
    ->click('.PlusButton button')
    ->type('.GoogleImageSearch input', 'lenka')
    ->click('.GoogleImageSearch button')
    ->click('.GoogleImageResult:eq(3) img');


$app->export();
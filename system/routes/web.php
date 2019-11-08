<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//public routes
Auth::routes();
Route::get('/form', 'PublicFormController@form');
Route::post('/form/submit', 'PublicFormController@formSubmit');
Route::get('/form/thankyou', 'PublicFormController@thankyou');
Route::get('/form/disqualified', 'PublicFormController@disqualified');
Route::get('/form/waitlisted', 'PublicFormController@waitlisted');
Route::get('/file/form/{file}', 'PublicFormController@file');

//portal routes
Route::get('/', 'DonorController@index')->name('home');
Route::get('/documents', 'DonorController@documents')->name('documents');
Route::get('/forms', 'DonorController@forms')->name('forms');
Route::get('/donor/form', 'DonorFormController@form');
Route::post('/donor/form/submit', 'DonorFormController@formSubmit');
Route::get('/messages', 'DonorController@messages')->name('messages');

Route::get('/milkit/send', 'DonorController@milkkitSend')->name('milkkit_send');
Route::get('/bloodkits', 'DonorController@bloodkit')->name('bloodkits');
Route::get('/account', 'DonorController@account')->name('account');
Route::get('/file', 'DonorController@file')->name('file');
Route::get('/file/edit', 'DonorController@edit')->name('edit');

Route::get('/messages/message', 'DonorController@message')->name('message');
Route::post('/messages/create', 'MessageController@create')->name('messages.create');


Route::get('/admin', 'Admin\ViewsController@dashboard')->name('admin');

Route::get('/admin/settings', 'Admin\Settings\ViewController@list')->name('admin.settings');
Route::post('/admin/settings/save', 'Admin\Settings\ActionController@save')->name('admin.settings.save');

Route::get('/admin/forms', 'Admin\ViewsController@forms')->name('admin.forms');

Route::get('/admin/shipping', 'Admin\Shipping\ViewController@list')->name('admin.shipping');
Route::get('/admin/shipping/create', 'Admin\Shipping\ViewController@create')->name('admin.shipping.create');
Route::post('/admin/shipping/create', 'Admin\Shipping\ActionController@save')->name('admin.shipping.save');
Route::post('/admin/shipping/export', 'Admin\Shipping\ViewController@export')->name('admin.shipping.export');
Route::get('/admin/shipping/export/download', 'Admin\Shipping\ViewController@download')->name('admin.shipping.export.download');

// admin Donor
Route::get('/admin/donors', 'Admin\Donor\ViewController@list')->name('admin.donors');
Route::get('/admin/donors/create', 'Admin\Donor\ViewController@create')->name('admin.donor.create');
Route::get('/admin/donors/update', 'Admin\Donor\ViewController@update')->name('admin.donor.update');
Route::get('/admin/donors/donor', 'Admin\Donor\ViewController@single')->name('admin.donor');
Route::get('/admin/donors/delete', 'Admin\Donor\ActionController@delete')->name('admin.donor.delete');
Route::post('/admin/donors/create', 'Admin\Donor\ActionController@create')->name('admin.donor.create');
Route::post('/admin/donors/update', 'Admin\Donor\ActionController@update')->name('admin.donor.update');




// admin User
Route::get('/admin/users', 'Admin\User\ViewController@list')->name('admin.users');
Route::get('/admin/users/user', 'Admin\User\ViewController@single')->name('admin.user');
Route::get('/admin/user/create', 'Admin\User\ViewController@create')->name('admin.user.create');
Route::get('/admin/user/update', 'Admin\User\ViewController@update')->name('admin.user.update');
Route::get('/admin/user/delete', 'Admin\User\ActionController@delete')->name('admin.user.delete');
Route::post('/admin/user/create', 'Admin\User\ActionController@create')->name('admin.user.create');
Route::post('/admin/user/update', 'Admin\User\ActionController@update')->name('admin.user.update');

// admin Notifications
Route::get('/admin/notifications', 'Admin\Notification\ViewController@list')->name('admin.notifications');
Route::get('/admin/notifications/notification', 'Admin\Notification\ViewController@single')->name('admin.notification');
Route::get('/admin/notification/create', 'Admin\Notification\ViewController@create')->name('admin.notification.create');
Route::get('/admin/notification/update', 'Admin\Notification\ViewController@update')->name('admin.notification.update');
Route::get('/admin/notification/delete', 'Admin\Notification\ActionController@delete')->name('admin.notification.delete');
Route::post('/admin/notification/create', 'Admin\Notification\ActionController@create')->name('admin.notification.create');
Route::post('/admin/notification/update', 'Admin\Notification\ActionController@update')->name('admin.notification.update');



// admin Permissions
Route::get('/admin/permissions', 'Admin\Permission\ViewController@list')->name('admin.permissions');
Route::get('/admin/permissions/permission', 'Admin\Permission\ViewController@single')->name('admin.permission');
Route::get('/admin/permission/create', 'Admin\Permission\ViewController@create')->name('admin.permission.create');
Route::get('/admin/permission/update', 'Admin\Permission\ViewController@update')->name('admin.permission.update');
Route::get('/admin/permission/delete', 'Admin\Permission\ActionController@delete')->name('admin.permission.delete');
Route::post('/admin/permission/create', 'Admin\Permission\ActionController@create')->name('admin.permission.create');
Route::post('/admin/permission/update', 'Admin\Permission\ActionController@update')->name('admin.permission.update');






/* forms builder*/
Route::get('/admin/forms', 'Admin\Form\ViewController@list')->name('admin.forms');
Route::get('/admin/forms/form', 'Admin\Form\ViewController@single')->name('admin.form');
Route::get('/admin/form/create', 'Admin\Form\ViewController@create')->name('admin.form.create');
Route::get('/admin/form/update', 'Admin\Form\ViewController@update')->name('admin.form.update');
Route::get('/admin/form/delete', 'Admin\Form\ViewController@delete')->name('admin.form.delete');

Route::post('/admin/form/create', 'Admin\Form\ActionController@create')->name('admin.form.create');
Route::post('/admin/form/update', 'Admin\Form\ActionController@update')->name('admin.form.update');


//submissions
Route::get('/admin/forms/submissions', 'Admin\Submission\ViewController@list')->name('admin.forms.submissions');
Route::get('/admin/forms/submissions/submission', 'Admin\Submission\ViewController@single')->name('admin.forms.submissions.submission');
Route::post('/admin/forms/submissions/submission/map', 'Admin\Submission\ViewController@map')->name('admin.forms.submissions.submission.map');

//questions
Route::get('/admin/forms/questions', 'Admin\Question\ViewController@list')->name('admin.forms.questions');
Route::get('/admin/forms/questions/question', 'Admin\Question\ViewController@single')->name('admin.forms.question');
Route::get('/admin/forms/questions/delete', 'Admin\Question\ActionController@delete')->name('admin.forms.questions.delete');
Route::get('/admin/forms/questions/map', 'Admin\Question\ViewController@map')->name('admin.forms.questions.map');
Route::get('/admin/forms/questions/create', 'Admin\Question\ViewController@create')->name('admin.forms.questions.create');
Route::get('/admin/forms/questions/update', 'Admin\Question\ViewController@update')->name('admin.forms.questions.update');
Route::post('/admin/forms/questions/save', 'Admin\Question\ActionController@create')->name('admin.forms.questions.save');
Route::post('/admin/forms/questions/update', 'Admin\Question\ActionController@update')->name('admin.forms.questions.question.update');
Route::post('/admin/forms/questions/map/save', 'Admin\Question\ActionController@map')->name('admin.forms.questions.map.save');

//Menu Admin Panel
Route::get('/admin/menus', 'Admin\Menu\ViewController@list')->name('admin.menus');
Route::get('/admin/menus/menu', 'Admin\Menu\ViewController@single')->name('admin.menu');
Route::get('/admin/menu/create', 'Admin\Menu\ViewController@create')->name('admin.menu.create');
Route::get('/admin/menu/update', 'Admin\Menu\ViewController@update')->name('admin.menu.update');
Route::get('/admin/menu/delete', 'Admin\Menu\ActionController@delete')->name('admin.menu.delete');
Route::post('/admin/menu/create', 'Admin\Menu\ActionController@create')->name('admin.menu.create');
Route::post('/admin/menu/update', 'Admin\Menu\ActionController@update')->name('admin.menu.update');

//Page Admin Panel
Route::get('/admin/pages', 'Admin\Page\ViewController@list')->name('admin.pages');
Route::get('/admin/pages/page', 'Admin\Page\ViewController@single')->name('admin.page');
Route::get('/admin/page/create', 'Admin\Page\ViewController@create')->name('admin.page.create');
Route::get('/admin/page/update', 'Admin\Page\ViewController@update')->name('admin.page.update');
Route::get('/admin/page/delete', 'Admin\Page\ActionController@delete')->name('admin.page.delete');
Route::post('/admin/page/create', 'Admin\Page\ActionController@create')->name('admin.page.create');
Route::post('/admin/page/update', 'Admin\Page\ActionController@update')->name('admin.page.update');


//Menu Item Admin Panel
Route::get('/admin/menu-items', 'Admin\MenuItem\ViewController@list')->name('admin.menu-items');
Route::get('/admin/menu-items/menu-item', 'Admin\MenuItem\ViewController@single')->name('admin.menu-item');
Route::get('/admin/menu-item/create', 'Admin\MenuItem\ViewController@create')->name('admin.menu-item.create');
Route::get('/admin/menu-item/update', 'Admin\MenuItem\ViewController@update')->name('admin.menu-item.update');
Route::get('/admin/menu-item/delete', 'Admin\MenuItem\ActionController@delete')->name('admin.menu-item.delete');
Route::post('/admin/menu-item/create', 'Admin\MenuItem\ActionController@create')->name('admin.menu-item.create');
Route::post('/admin/menu-item/update', 'Admin\MenuItem\ActionController@update')->name('admin.menu-item.update');



// admin messages
Route::get('/admin/message', 'Admin\Message\ViewController@list')->name('admin.message');
Route::get('/admin/message/view', 'Admin\Message\ViewController@view')->name('admin.message.view');
Route::get('/admin/message/create', 'Admin\Message\ViewController@create')->name('admin.message.create');
Route::get('/admin/message/update', 'Admin\Message\ViewController@update')->name('admin.message.update');

Route::post('/admin/message/create', 'Admin\Message\ActionController@create')->name('admin.message.create');
Route::post('/admin/message/reply', 'Admin\Message\ActionController@reply')->name('admin.message.reply');
Route::post('/admin/message/update', 'Admin\Message\ActionController@update')->name('admin.message.update');
Route::post('/admin/message/seen', 'Admin\Message\ActionController@seen')->name('admin.message.seen');

Route::get('/system/sync', 'APIController@sync');

Route::get('/{any?}', 'PagesController@handler');
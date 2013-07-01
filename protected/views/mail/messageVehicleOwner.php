Здравствуйте!


Пользователь <?php echo $model->author->profiles->fullName() ?> отправил Вам сообщение со страницы Вашего транспорта "<?php echo $object->id ?> - <?php echo ucfirst($object->vehicleType->name_ru) . " " . $object->marka->name . (isset($object->modeli->name) ? ' ' . $object->modeli->name : '') ?>,
											номер: <?php echo $object->license_plate ?>":

************************************

<?php echo $model->message ?>

************************************

Если у Вас возникли какие-либо вопросы по нашему сервису, обратитесь к администрации сайта www.frahts.com: support@frahts.com


С уважением,

Администрация сайта www.frahts.com
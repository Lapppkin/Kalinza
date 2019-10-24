<div class="consult-form-container container">
    <div class="row">
        <div class="col-12">
            <div class="consult-form">
                <div class="consult-form-wrapper">
                    <h2 class="h1 consult-form-title">Не нашли, что искали?</h2>
                    <p>Напишите нам, и наши менеджеры проконсультируют<br>вас по вашему вопросу.</p>
                    <div>
                        <form id="consult-form" method="post" action="<?= SITE_DIR . 'include/mail/mail.php' ?>">
                            <?= bitrix_sessid_post() ?>
                            <div class="form-item">
                                <label for="consult-name" hidden></label>
                                <input type="text" name="name" id="consult-name" required placeholder="Ваше имя *">
                            </div>
                            <div class="form-item">
                                <label for="consult-phone" hidden></label>
                                <input type="text" name="phone" id="consult-phone" required placeholder="Ваш телефон/email *">
                            </div>
                            <div class="form-item">
                                <button type="submit" class="btn">Отправить</button>
                            </div>
                        </form>
                    </div>
                    <p>Нажимая на кнопку «Отправить», я даю согласие на <a href="/privacy" target="_blank">обработку персональных данных</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

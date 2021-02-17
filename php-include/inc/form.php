					<form class="form" action="" method="post">
						<div class="form_group">
							<label class="form_label" for="form_name">お名前<span class="required"> ※</span></label>
							<input class="form_control" id="form_name" type="text">
							<span class="input_type">[ 全角 ]</span>
						</div>
						<div class="form_group">
							<fieldset>
								<legend class="form_label">性別</legend>
								<div class="form_check">
									<input class="form_radio_input" id="form_radio1" type="radio" name="radio1" value="option1" checked>
									<label class="form_check_label" for="form_radio1">男性</label>
								</div>
								<div class="form_check">
									<input class="form_radio_input" id="form_radio2" type="radio" name="radio1" value="option2">
									<label class="form_check_label" for="form_radio2">女性</label>
								</div>
							</fieldset>
						</div>
						<div class="form_group">
							<label class="form_label" for="form_tel">お電話番号<span class="required"> ※</span></label>
							<input class="form_control" id="form_tel" type="email">
							<span class="input_type">[ 半角英数 ]</span>
						</div>
						<div class="form_group">
							<label class="form_label" for="form_email">メールアドレス<span class="required"> ※</span></label>
							<input class="form_control" id="form_email" type="email">
							<span class="input_type">[ 半角英数 ]</span>
						</div>
						<div class="form_group">
							<label class="form_label" for="form_textarea">内容<span class="required"> ※</span></label>
							<textarea class="form_control_textarea" id="form_textarea" rows="7"></textarea>
							<span class="input_type">[ 全角 ]</span>
						</div>
						<div class="form_button_group">
							<button class="form_button submit" type="submit">送信内容を確認</button>
							<button class="form_button reset" type="reset">リセット</button>
						</div>
					</form>

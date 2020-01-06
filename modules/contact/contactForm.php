<form id="contact-form-act" name="contact-form-act" class="needs-validation" novalidate>
    <div class="form-group">
        <input type="text" class="form-control error" name="inputFullName" id="inputFullName" required placeholder="Họ và tên" />
    </div>
    <div class="form-group">
        <input type="email" class="form-control error" name="inputEmail" id="inputEmail" required placeholder="Email" />
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="inputPhone" id="inputPhone" required placeholder="Điện thoại" />
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="inputNganhnghe" id="inputNganhnghe" required placeholder="Ngành nghề kinh doanh" />
    </div>
    <div class="form-group">
        <select class="form-control" id="selectService" name="selectService">
			<option value="">Chọn dịch vụ</option>
			<option value="Thiết kế website">Thiết kế website</option>
			<option value="Tư vấn chiến lược marketing">Tư vấn chiến lược marketing</option>
			<option value="Quảng cáo Adwords, Facebook">Quảng cáo Adwords, Facebook</option>
			<option value="Thiết lập hệ thống Affiliate/ CSKH">Thiết lập hệ thống Affiliate/ CSKH</option>
        </select>
    </div>
    <div class="form-group">
        <textarea class="form-control" id="inputContent" name="inputContent" required rows="3" placeholder="Nội dung"></textarea>
    </div>
    <button type="button" id="js-btn-contact-form-act" class="btn">Gửi liên hệ</button>
</form>
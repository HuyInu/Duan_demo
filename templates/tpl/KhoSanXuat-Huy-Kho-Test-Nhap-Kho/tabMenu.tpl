<div class="ChonLoaiPhieu">
    <ul>
        <li <!--{if $smarty.request.act eq '' || $smarty.request.act eq 'edit' || $smarty.request.act eq 'editTinhChatCapGia'}-->class="active"<!--{/if}-->>
            <a href="<!--{$path_url}-->/sources/==.php?cid=3228" title="Bảng Tính Giá">
                TỔNG HỢP
            </a>
        </li>
        <li <!--{if $smarty.request.act eq 'BangTinhGiaChiTiet'}-->class="active"<!--{/if}-->>
            <a href="<!--{$path_url}-->/sources/==.php?act=BangTinhGiaChiTiet&cid=3228" title="Bảng Tính Giá Chi Tiết">
                CHỜ NHẬP KHO
            </a>
        </li>
        <li <!--{if $smarty.request.act eq 'ToaHangNhaCungCap' || $smarty.request.act eq 'ToaHangNhaCungCapEdit'}-->class="active"<!--{/if}-->>
            <a href="<!--{$path_url}-->/sources/==.php?act=ToaHangNhaCungCap&cid=3228" title="Bảng Tính Giá Chi Tiết">
                ĐÃ XÁC NHẬP NHẬP KHO
            </a>
        </li>
    </ul>
</div>
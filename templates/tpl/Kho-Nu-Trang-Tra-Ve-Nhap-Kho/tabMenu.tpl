<div class="ChonLoaiPhieu">
    <ul>
        <li <!--{if !$smarty.request.act}-->class="active"<!--{/if}-->>
            <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?cid=<!--{$smarty.request.cid}-->" title="Tổng hộp">
                TỔNG HỢP
            </a>
        </li>
        <li <!--{if $smarty.request.act eq 'uninsertShow'}-->class="active"<!--{/if}-->>
            <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=uninsertShow&cid=<!--{$smarty.request.cid}-->" title="Chờ nhập kho">
                CHỜ NHẬP KHO
            </a>
        </li>
        <li <!--{if $smarty.request.act eq 'insertedShow'}-->class="active"<!--{/if}-->>
            <a href="<!--{$path_url}-->/sources/Kho-Nu-Trang-Tra-Ve-Nhap-Kho.php?act=insertedShow&cid=<!--{$smarty.request.cid}-->" title="Đã xác nhận nhập kho">
                ĐÃ XÁC NHẬP NHẬP KHO
            </a>
        </li>
    </ul>
</div>
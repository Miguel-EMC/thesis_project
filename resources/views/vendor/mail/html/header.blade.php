@props(['url'])
<tr>
<td class="header">
@if (trim($slot) === 'Laravel')
<img src="https://res.cloudinary.com/duurdhf06/image/upload/v1674363160/Logo_gd_npj4tf.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

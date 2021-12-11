<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
@if(false)<img src="{{ Storage::url('logo.png') }}" class="logo" alt="">@endif
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

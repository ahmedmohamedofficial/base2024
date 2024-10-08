@extends('admin.excel_layouts.index-for-excel')
@section('content')

    @if(!empty($records))
        <table class="table m-b-xs">
            <tbody>
            <tr style="background-color: red!important;color: red!important;">
                <th style="text-align: center;background-color: #0a6ebd;color: #ffffff;">#</th>
                <th style="text-align: center;background-color: #0a6ebd;color: #ffffff;">{{ __('admin.name') }}</th>
                <th style="text-align: center;background-color: #0a6ebd;color: #ffffff;">{{ __('admin.phone') }}</th>
                <th style="text-align: center;background-color: #0a6ebd;color: #ffffff;">{{ __('admin.gender') }}</th>
                <th style="text-align: center;background-color: #0a6ebd;color: #ffffff;">{{ __('admin.image') }}</th>
                <th style="text-align: center;background-color: #0a6ebd;color: #ffffff;">{{ __('admin.city') }}</th>
                <th style="text-align: center;background-color: #0a6ebd;color: #ffffff;">{{ __('admin.ban_status') }}</th>
                <th style="text-align: center;background-color: #0a6ebd;color: #ffffff;">{{  __('admin.created_at') }}</th>
            </tr>
            @if(!empty($records))

                @foreach ($records as  $record)
                    <tr class="delete_row">
                        <td style="text-align: center;background-color: #0a6ebd;color: #ffffff;">{{ $loop->iteration }}</td>
                        <td style="text-align: center">{{ $record->name }}</td>
                        <td style="text-align: center">
                            <a href="tel:{{ $record->fullPhone }}">{{ $record->fullPhone }}</a></td>
                        <td style="text-align: center">{{ $record->genderText['title']}}</td>
                        <td style="text-align: center">{{$record->avatar}}</td>
                        <td style="text-align: center">{{ $record->city?->name }}</td>
                        <td style="text-align: center">
                            @if ($record->is_blocked)
                                {{ __('admin.Prohibited')  }}
                            @else
                                {{ __('admin.Unspoken') }}
                            @endif
                        </td>
                        <td style="text-align: center">{{ $record->createdAtFormat }}</td>
                    </tr>
                @endforeach

            @else
                <tr>
                    <td style="text-align: center" colspan="5"></td>
                </tr>
            @endif

            </tbody>
        </table>
    @endif
@stop

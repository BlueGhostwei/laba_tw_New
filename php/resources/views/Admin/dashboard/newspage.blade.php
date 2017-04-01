@foreach($data as $new)
<tr>
    <td>{{$new->order_code}}</td>
    <td>{{$new->title}}</td>
    <td>{{$new->news_type}}</td>
    <td>{{$new->created_at}}</td>
    <td>{{$new->price}}</td>
    <td>{{$new->release_sta}}</td>
    <td><select>
            <option>删除</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select></td>
</tr>
@endforeach
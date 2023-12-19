
<p>The following contact took place.</p>
 

 
<div>
	<p><b>Full Name:</b> &nbsp; {{ $contact->name }}  {{ $contact->name2 }} </p>
	<p><b>Phone: </b> &nbsp; {{ $contact->phone }}   </p>
	<p><b>Email: </b> &nbsp; <a href = "mailto:{{ $contact->email }}" target = "_blank">  {{ $contact->email }} </a> </p>

	<p><b>Message: </b> &nbsp;  {!! nl2br(e($contact->message )) !!}  </p>
</div>
 

 

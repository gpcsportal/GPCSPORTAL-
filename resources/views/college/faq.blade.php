<div class="college-faq">
@foreach([
'How do I apply?' => 'Contact the college to confirm the current admission route, eligibility, dates and required documents before submitting an application.',
'Where can I confirm fees?' => 'Ask the college for the current approved fee schedule, payment method and any scholarship information that applies to you.',
'How do I access papers, notes and results?' => 'Use the existing Student Login or GPCS Sign In. Academic resources follow the portal’s existing access rules.',
'Can faculty use the portal?' => 'Yes. The GPCS Sign In page includes the existing Faculty Login and faculty registration options.',
'What are the upload limits?' => 'The maximum paper limit is 100 MB and the maximum notes limit is 200 MB. The active form shows any lower limit set by the Admin. Uploads are reviewed before approval.',
'Where is the campus?' => 'The college is on Chhatri Road in Shivpuri, Madhya Pradesh.'
] as $question=>$answer)
<details><summary>{{ $question }}</summary><p>{{ $answer }}</p></details>
@endforeach
</div>

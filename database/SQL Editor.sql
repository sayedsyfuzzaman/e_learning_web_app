insert into history(title, comment_one, comment_two, added_by, date)
values('New course added', 'Course ID: 125', 'Course Name: JAVA', '2021-1001-12', now());

select title, comment_one, comment_two, comment_three, comment_four, DATE_FORMAT(date, "%M %d %Y, %r") as date from history where added_by = '2021-1002-12';

insert into enrolled_course values ('21-10001-12', '124', now(), 200);

select c.thumbnail, c.course_name, c.course_id, ec.course_price,  DATE_FORMAT(ec.enrolled_at, "%d %b, %Y - %h:%i %p") as enrolled_at from course_info c, enrolled_course ec where c.course_id = ec.course_id and ec.learner_id = '21-10002-12';

select now();

select title, comment_one, comment_two, comment_three, comment_four, DATE_FORMAT(date, "%d %b, %Y - %h:%i %p")as date from history where added_by = '21-10001-12' ORDER BY date DESC;
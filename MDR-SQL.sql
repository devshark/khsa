select c.Client_Name, g.last_name, g.first_name,
educ.status,g.license_num, g.`license_expiry_date`,
f.FireArm_Serial_No, f.`FireArm_Name`,f.`Manufactuer_ID`
from tblclient c
inner join tbldeployment d
on c.client_id=d.clientid
inner join tblguards g
on d.guardid = g.id
inner join tblstatus educ
on g.`educational_attainment`=educ.id
inner join tblstatus stat
on g.`status`=stat.id
inner join tblfirearm f
on d.`firearm_SN` = f.`FireArm_Serial_No`
where d.`guard_status`='hired'
order by d.`clientid`